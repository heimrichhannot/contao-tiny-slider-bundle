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
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Config
{
    /**
     * Get tiny slider attributes from config model or config model id
     *
     * @param int|TinySliderConfigModel $config
     *
     * @return string
     */
    public function getAttributes($config, $container = '.tiny-slider-container'): string
    {
        $cache      = new FilesystemAdapter('', 0, System::getContainer()->get('kernel')->getCacheDir());
        $cacheKey   = 'tinySliderConfig_'.(is_numeric($config) ? $config : $config->id). '' . $container;
        $cacheItem  = $cache->getItem($cacheKey);
        $configData = $cacheItem->get();

        if (true === System::getContainer()->getParameter('kernel.debug') || !$cacheItem->isHit() || empty($configData)) {
            if (is_numeric($config)) {
                /** @var TinySliderConfigModel $adapter */
                $adapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);
                $config  = $adapter->findByPk((int)$config);
            }

            if (null === $config) {
                return '';
            }

            $configData              = $this->createConfig($config);
            $configData['container'] = $container;

            $cacheItem->expiresAfter(\DateInterval::createFromDateString('4 hour'));
            $cacheItem->set($configData);

            $cache->save($cacheItem);
        }

        $attributes = ' data-tiny-slider-config="'.htmlspecialchars(json_encode($configData), ENT_QUOTES, \Contao\Config::get('characterSet')).'"';

        return $attributes;
    }

    public function createConfig($objConfig, $palette = 'default')
    {
        Controller::loadDataContainer('tl_tiny_slider_spread');

        /** @var TinySliderConfigModel $modelAdapter */
        $configModelAdapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);

        $arrConfig = [];

        $translations = System::getContainer()->get('translator')->getCatalogue()->all();
        $messages     = $translations['messages'];

        $fields = System::getContainer()->get('huh.tiny_slider.util.dca')->getPaletteFields($palette, $GLOBALS['TL_DCA']['tl_tiny_slider_spread'], 'tl_tiny_slider_config');

        $data = array_intersect_key($objConfig->row(), $fields);

        foreach ($data as $key => $value) {
            if (false === strstr($key, 'tinySlider_')) {
                continue;
            }

            if (!isset($GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields'][$key])) {
                continue;
            }

            $arrData = $GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields'][$key];

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

            if (isset($arrData['eval']['tinySliderArray']) && '' != $value) {
                $arrayKey                                                             = key($arrData['eval']['tinySliderArray']);
                $arrConfig[$arrayKey][$arrData['eval']['tinySliderArray'][$arrayKey]] = $value;
                continue;
            }

            if ($arrData['eval']['multiple'] || 'multiColumnEditor' == $arrData['inputType']) {
                $value = StringUtil::deserialize($value, true);
            }

            // check type as well, otherwise
            if ('' === $value) {
                continue;
            }

            if ($value == $arrData['default']) {
                continue;
            }

            if ($key) {
                $arrConfig[$tinySliderKey] = $value;
            }
        }

        $arrResponsive = [];

        if ($palette !== 'responsive' && isset($arrConfig['responsive'])) {

            $value = $arrConfig['responsive'];

            foreach ($value as $config) {
                if (empty($config['configuration'])) {
                    continue;
                }

                $objResponsiveConfig = $configModelAdapter->findByPk($config['configuration']);

                if (null === $objResponsiveConfig) {
                    continue;
                }

                $responsiveConfig                     = $this->createConfig($objResponsiveConfig, 'responsive');
                $arrResponsive[$config['breakpoint']] = array_diff_assoc($responsiveConfig, $arrConfig); // only differences
            }

            unset($arrConfig['responsive']);
        }

        if (!empty($arrResponsive)) {
            $arrConfig['responsive'] = $arrResponsive;
        }

        return $arrConfig;
    }

    public function getTinySliderContainerSelectorFromModel($objConfig)
    {
        return '.'.$this->getTinySliderCssClassFromModel($objConfig).' .tiny-slider-container';
    }

    public function getTinySliderCssClassFromModel($objConfig)
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

    /**
     * Get CSS Class from config model or config model id
     *
     * @param int|TinySliderConfigModel $config
     *
     * @return string
     */
    public function getCssClass($config): string
    {
        if (is_numeric($config)) {
            /** @var TinySliderConfigModel $adapter */
            $adapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);
            $config  = $adapter->findByPk((int)$config);
        }

        if (null === $config) {
            return '';
        }

        return $this->getTinySliderCssClassFromModel($config).(strlen($config->cssClass) > 0 ? ' '.$config->cssClass : '').' tiny-slider-uid-'.uniqid().' tiny-slider';
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
