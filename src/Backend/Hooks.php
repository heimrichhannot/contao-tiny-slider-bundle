<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Backend;

use Contao\System;

class Hooks extends \Controller
{
    private static $strSpreadDca = 'tl_tiny_slider_spread';

    /**
     * Spread Fields to existing DataContainers.
     *
     * @param string $strName
     *
     * @return bool false if Datacontainer not supported
     */
    public function loadDataContainerHook($strName)
    {
        \Controller::loadDataContainer(static::$strSpreadDca);

        if (!is_array($GLOBALS['TL_TINY_SLIDER']['SUPPORTED']) || !in_array($strName, array_keys($GLOBALS['TL_TINY_SLIDER']['SUPPORTED']), true)) {
            return false;
        }

        if (!is_array($GLOBALS['TL_DCA'][static::$strSpreadDca]['fields'])) {
            $GLOBALS['TL_DCA'][static::$strSpreadDca]['fields'] = [];
        }

        $dc = &$GLOBALS['TL_DCA'][$strName];

        if (null === $dc) {
            return;
        }
        
        if(isset($dc['config']['ctable']) && is_array($dc['config']['ctable']) && in_array('tl_content', $dc['config']['ctable']))
        {
            \Controller::loadDataContainer('tl_content');
        }

        foreach ($GLOBALS['TL_TINY_SLIDER']['SUPPORTED'][$strName] as $strPalette => $replace) {
            preg_match_all('#\[\[(?P<constant>.+)\]\]#', $replace, $matches);

            if (!isset($matches['constant'][0])) {
                continue;
            }

            $strConstant = $matches['constant'][0];
            $strReplacePalette = @constant($matches['constant'][0]);

            $pos = strpos($replace, '[['.$strConstant.']]');
            $search = str_replace('[['.$strConstant.']]', '', $replace);

            // prepend slick config palette
            if ($pos < 1) {
                $replace = $GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes'][$strReplacePalette].$search;
            } // append slick config palette
            else {
                $replace = $search.$GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes'][$strReplacePalette];
            }

            $arrFields = System::getContainer()->get('huh.tiny_slider.util.dca')->getPaletteFields($strReplacePalette, $dc);

            $arrFieldKeys = array_keys($arrFields);

            // inject palettes
            // create palette if not existing
            if (!isset($dc['palettes'][$strPalette])) {
                $dc['palettes'][$strPalette] = $replace;
            } else {
                // do not replace multiple times
                if (!$replace || false !== strpos($dc['palettes'][$strPalette], $replace)) {
                    continue;
                }

                $dc['palettes'][$strPalette] = str_replace($search, $replace, $dc['palettes'][$strPalette]);
            }

            if (!is_array($GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes']['__selector__'])) {
                $GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes']['__selector__'] = [];
            }

            // inject subplattes & selectors
            $arrSelectors = array_intersect($GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes']['__selector__'], $arrFieldKeys);

            if (!empty($arrSelectors)) {
                $dc['palettes']['__selector__'] = array_merge(is_array($dc['palettes']['__selector__']) ? $dc['palettes']['__selector__'] : [], $arrSelectors);

                foreach ($arrSelectors as $key) {
                    $arrFields = array_merge($arrFields, System::getContainer()->get('huh.tiny_slider.util.dca')->getPaletteFields($key, $dc, 'subpalettes'));
                }

                $dc['subpalettes'] = array_merge(is_array($dc['subpalettes']) ? $dc['subpalettes'] : [], $GLOBALS['TL_DCA'][static::$strSpreadDca]['subpalettes']);
            }

            if (!is_array($arrFields)) {
                return;
            }

            // inject fields
            $dc['fields'] = array_merge($arrFields, (is_array($dc['fields']) ? $dc['fields'] : []));
        }

        \System::loadLanguageFile(static::$strSpreadDca);
        \System::loadLanguageFile($strName);

        // add language to TL_LANG palette
        if (is_array($GLOBALS['TL_LANG'][static::$strSpreadDca])) {
            $GLOBALS['TL_LANG'][$strName] = array_merge(is_array($GLOBALS['TL_LANG'][$strName]) ? $GLOBALS['TL_LANG'][$strName] : [], $GLOBALS['TL_LANG'][static::$strSpreadDca]);
        }
    }
}
