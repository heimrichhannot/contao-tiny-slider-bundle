<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
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
     * Get tiny slider attributes from config model or config model id.
     *
     * @param $config
     * @param string $container Selector of the tiny slider container
     *
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getAttributes($config, $container = '.tiny-slider-container'): string
    {
        $cache = new FilesystemAdapter('', 0, System::getContainer()->get('kernel')->getCacheDir());
        $cacheKey = 'tinySliderConfig_'.System::getContainer()->get('kernel')->getEnvironment().'_'.(is_numeric($config) ? $config : $config->id).''.$container;
        $cacheItem = $cache->getItem($cacheKey);
        $configData = $cacheItem->get();

        if (true === System::getContainer()->getParameter('kernel.debug') || !$cacheItem->isHit() || empty($configData)) {
            if (is_numeric($config)) {
                /** @var TinySliderConfigModel $adapter */
                $adapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);
                $config = $adapter->findByPk((int) $config);
            }

            if (null === $config) {
                return '';
            }

            $configData = $this->createConfig($config);
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
        $messages = $translations['messages'];

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

            $tinySliderKey = substr($key, \strlen('tinySlider_')); // trim tinySlider_ prefix

            if ('digit' == $arrData['eval']['rgxp']) {
                $value = (int) $value;
            }

            if ('checkbox' == $arrData['inputType'] && !$arrData['eval']['multiple']) {
                $value = (bool) filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }

            if (\is_string($value) && isset($messages[$value])) {
                $value = System::getContainer()->get('translator')->trans($value);
            }

            if (isset($arrData['eval']['tinySliderArray']) && '' != $value) {
                $arrayKey = key($arrData['eval']['tinySliderArray']);
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

            if ($key) {
                $arrConfig[$tinySliderKey] = $value;
            }
        }

        $arrResponsive = [];

        if ('responsive' !== $palette && isset($arrConfig['responsive'])) {
            $value = $arrConfig['responsive'];

            // sort by breakpoint asc in order to maintain mobile first
            usort($value, function ($a, $b) {
                return $a['breakpoint'] <=> $b['breakpoint'];
            });

            foreach ($value as $config) {
                if (empty($config['configuration'])) {
                    continue;
                }

                $objResponsiveConfig = $configModelAdapter->findByPk($config['configuration']);

                if (null === $objResponsiveConfig) {
                    continue;
                }

                $responsiveConfig = $this->createConfig($objResponsiveConfig, 'responsive');

                // only add differences between parent config or previous breakpoint responsive config
                if (empty($arrResponsive)) {
                    $arrResponsive[$config['breakpoint']] = array_merge(array_intersect($responsiveConfig, $arrConfig), $responsiveConfig);
                } else {
                    $prevResponsiveConfig = end($arrResponsive);
                    $arrResponsive[$config['breakpoint']] = array_merge($prevResponsiveConfig, $responsiveConfig);
                }

                $arrResponsive[$config['breakpoint']] = $responsiveConfig;
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
        $classname = \get_class($obj);

        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            $classname = $matches[1];
        }

        return $classname;
    }

    /**
     * Get CSS Class from config model or config model id.
     *
     * @param int|TinySliderConfigModel $config
     */
    public function getCssClass($config): string
    {
        if (is_numeric($config)) {
            /** @var TinySliderConfigModel $adapter */
            $adapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);
            $config = $adapter->findByPk((int) $config);
        }

        if (null === $config) {
            return '';
        }

        return $this->getTinySliderCssClassFromModel($config).(\strlen($config->cssClass) > 0 ? ' '.$config->cssClass : '').' tiny-slider-uid-'.uniqid().' tiny-slider';
    }

    /**
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
