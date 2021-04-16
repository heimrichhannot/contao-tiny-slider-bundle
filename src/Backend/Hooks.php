<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Backend;

use Contao\Controller;
use Contao\System;

class Hooks extends Controller
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
        Controller::loadDataContainer(static::$strSpreadDca);

        if (!\is_array($GLOBALS['TL_TINY_SLIDER']['SUPPORTED']) || !\in_array($strName, array_keys($GLOBALS['TL_TINY_SLIDER']['SUPPORTED']), true)) {
            return false;
        }

        if (!\is_array($GLOBALS['TL_DCA'][static::$strSpreadDca]['fields'])) {
            $GLOBALS['TL_DCA'][static::$strSpreadDca]['fields'] = [];
        }

        $dc = &$GLOBALS['TL_DCA'][$strName];

        if (null === $dc) {
            return;
        }

        if (isset($dc['config']['ctable']) && \is_array($dc['config']['ctable']) && \in_array('tl_content', $dc['config']['ctable'])) {
            Controller::loadDataContainer('tl_content');
        }

        foreach ($GLOBALS['TL_TINY_SLIDER']['SUPPORTED'][$strName] as $strPalette => $replace) {
            preg_match_all('#\[\[(?P<placeholder>.+)\]\]#', $replace, $matches);

            if (!isset($matches['placeholder'][0])) {
                continue;
            }

            $placeholder = $matches['placeholder'][0];

            $replacePaletteName = $matches['placeholder'][0];

            /*
             * Backward compatibility with palette constants (before version 1.7, should be removed with version 2.0)
             *
             * @ToDo Remove with version 2.0
             */
            if (null !== ($replacePaletteNameConstant = @\constant($matches['placeholder'][0]))) {
                $replacePaletteName = $replacePaletteNameConstant;
            }

            $pos = strpos($replace, '[['.$placeholder.']]');
            $search = str_replace('[['.$placeholder.']]', '', $replace);

            // prepend config palette
            if ($pos < 1) {
                $replace = $GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes'][$replacePaletteName].$search;
            } // append config palette
            else {
                $replace = $search.$GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes'][$replacePaletteName];
            }

            $arrFields = System::getContainer()->get('huh.tiny_slider.util.dca')->getPaletteFields($replacePaletteName, $dc);

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

            if (!\is_array($GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes']['__selector__'])) {
                $GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes']['__selector__'] = [];
            }

            // inject subplattes & selectors
            $arrSelectors = array_intersect($GLOBALS['TL_DCA'][static::$strSpreadDca]['palettes']['__selector__'], $arrFieldKeys);

            if (!empty($arrSelectors)) {
                $dc['palettes']['__selector__'] = array_merge(\is_array($dc['palettes']['__selector__']) ? $dc['palettes']['__selector__'] : [], $arrSelectors);

                foreach ($arrSelectors as $key) {
                    $arrFields = array_merge($arrFields, System::getContainer()->get('huh.tiny_slider.util.dca')->getPaletteFields($key, $dc, 'tl_tiny_slider_spread', 'subpalettes'));
                }

                $dc['subpalettes'] = array_merge(\is_array($dc['subpalettes']) ? $dc['subpalettes'] : [], $GLOBALS['TL_DCA'][static::$strSpreadDca]['subpalettes']);
            }

            if (!\is_array($arrFields)) {
                return;
            }

            // inject fields
            $dc['fields'] = array_merge($arrFields, (\is_array($dc['fields']) ? $dc['fields'] : []));
        }

        Controller::loadLanguageFile(static::$strSpreadDca);
        Controller::loadLanguageFile($strName);

        // add language to TL_LANG palette
        if (\is_array($GLOBALS['TL_LANG'][static::$strSpreadDca])) {
            $GLOBALS['TL_LANG'][$strName] = array_merge(\is_array($GLOBALS['TL_LANG'][$strName]) ? $GLOBALS['TL_LANG'][$strName] : [], $GLOBALS['TL_LANG'][static::$strSpreadDca]);
        }
    }
}
