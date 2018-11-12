<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Util;

use Contao\Controller;
use Contao\StringUtil;
use Contao\System;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;

class Config
{
    public function getAttributesFromModel($objConfig)
    {
        $arrData = $this->createConfig($objConfig);

        $attributes = ' data-tiny-slider-config="'.htmlspecialchars(json_encode($arrData['config']), ENT_QUOTES, \Contao\Config::get('characterSet')).'"';

        if ('' !== $objConfig->initCallback) {
            $attributes .= ' data-tiny-slider-init-callback="'.htmlspecialchars($objConfig->initCallback, ENT_QUOTES, \Contao\Config::get('characterSet')).'"';
        }

        if ('' !== $objConfig->afterInitCallback) {
            $attributes .= ' data-tiny-slider-after-init-callback="'.htmlspecialchars($objConfig->afterInitCallback, ENT_QUOTES, \Contao\Config::get('characterSet')).'"';
        }

        return $attributes;
    }

    public function createConfig($objConfig, $responsive = false)
    {
        Controller::loadDataContainer('tl_tiny_slider_spread');

        /** @var TinySliderConfigModel $modelAdapter */
        $configModelAdapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);

        $arrConfig  = [];
        $arrObjects = [];

        $translations = System::getContainer()->get('translator')->getCatalogue()->all();
        $messages     = $translations['messages'];

        foreach ($objConfig->row() as $key => $value) {
            if (false === strstr($key, 'tinySlider_')) {
                continue;
            }

            if (!isset($GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields'][$key])) {
                continue;
            }

            $arrData = $GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields'][$key];

            if (true === $responsive && (!isset($arrData['eval']['responsive']) || true !== $arrData['eval']['responsive'])) {
                continue;
            }

            $tinySliderKey = substr($key, strlen('tinySlider_')); // trim tinySlider_ prefix

            if ($arrData['eval']['rgxp'] == 'digit') {
                $value = (int)$value;
            }

            if ('checkbox' == $arrData['inputType'] && !$arrData['eval']['multiple']) {
                $value = (bool)filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }

            if (is_string($value) && isset($messages[$value])) {
                $value = System::getContainer()->get('translator')->trans($value);
            }

            if (isset($arrData['eval']['tinySliderArray'])) {
                $arrayKey                                                             = key($arrData['eval']['tinySliderArray']);
                $arrConfig[$arrayKey][$arrData['eval']['tinySliderArray'][$arrayKey]] = $value;
                continue;
            }

            if ($arrData['eval']['multiple'] || 'multiColumnEditor' == $arrData['inputType']) {
                $value = deserialize($value, true);
            }

            if ($arrData['eval']['isJsObject']) {
                $arrObjects[] = $tinySliderKey;
            }

            // check type as well, otherwise
            if ('' === $value) {
                continue;
            }

            if ('tinySlider_responsive' == $key) {
                $arrResponsive = [];

                foreach ($value as $config) {
                    if (empty($config['configuration'])) {
                        continue;
                    }

                    $objResponsiveConfig = $configModelAdapter->findByPk($config['configuration']);

                    if (null === $objResponsiveConfig) {
                        continue;
                    }

                    $settings = $this->createConfig($objResponsiveConfig, true);
                    unset($config['configuration']);

                    $arrResponsive[$config['breakpoint']] = $settings['config'];
                }

                if (empty($arrResponsive)) {
                    $value = false;
                } else {
                    $value = $arrResponsive;
                }
            }

            if ($key) {
                $arrConfig[$tinySliderKey] = $value;
            }
        }

        // remove responsive settings, otherwise center wont work
        if (empty($arrResponsive)) {
            unset($arrConfig['responsive']);
        }

        $arrReturn = [
            'config'  => $arrConfig,
            'objects' => $arrObjects,
        ];

        return $arrReturn;
    }

    public function getSlickContainerSelectorFromModel($objConfig)
    {
        return '.'.$this->getSlickCssClassFromModel($objConfig).' .tiny-slider-container';
    }

    public function getSlickCssClassFromModel($objConfig)
    {
        $strClass = $this->stripNamespaceFromClassName($objConfig);

        return 'tiny-slider-'.substr(md5($strClass.'_'.$objConfig->id), 0, 6);
    }

    public function stripNamespaceFromClassName($obj)
    {
        $classname = get_class($obj);

        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            $classname = $matches[1];
        }

        return $classname;
    }

    public function getCssClassFromModel($objConfig)
    {
        return $this->getSlickCssClassFromModel($objConfig).(strlen($objConfig->cssClass) > 0 ? ' '.$objConfig->cssClass : '').' tiny-slider-uid-'.uniqid().' tiny-slider';
    }

    /**
     * @param array                 $data
     * @param TinySliderConfigModel $config
     *
     * @return TinySliderConfigModel
     */
    public function createSettings(array $data, TinySliderConfigModel $config)
    {
        Controller::loadDataContainer('tl_tiny_slider_spread');

        $settings = $config;

        foreach ($data as $key => $value) {
            if ('tinySlider' != substr($key, 0, 10)) {
                continue;
            }

            $data = &$GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields'][$key];

            if ($data['eval']['multiple'] || 'tinySliderOrderSRC' == $key) {
                $value = StringUtil::deserialize($value, true);
            }

            $settings->{$key} = $value;
        }

        return $settings;
    }
}
