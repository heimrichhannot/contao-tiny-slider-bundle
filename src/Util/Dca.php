<?php
/**
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\TinySliderBundle\Util;

use Contao\Controller;
use Contao\StringUtil;

class Dca
{
    public function getPaletteFields($strPalette, $dc, $table = 'tl_tiny_slider_spread', $type = 'palettes')
    {
        Controller::loadDataContainer($table);

        $boxes = StringUtil::trimsplit(';', $GLOBALS['TL_DCA'][$table][$type][$strPalette]);

        $arrFields = [];

        if (!empty($boxes)) {
            foreach ($boxes as $k => $v) {
                $eCount = 1;
                $boxes[$k] = StringUtil::trimsplit(',', $v);

                foreach ($boxes[$k] as $kk => $vv) {
                    if (preg_match('/^\[.*\]$/', $vv)) {
                        ++$eCount;
                        continue;
                    }

                    if (preg_match('/^\{.*\}$/', $vv)) {
                        unset($boxes[$k][$kk]);
                    } else {
                        if (isset($GLOBALS['TL_DCA'][$table]['fields'][$vv])) {
                            $arrField = $GLOBALS['TL_DCA'][$table]['fields'][$vv];
                        } else {
                            if (isset($dc['fields'][$vv])) {
                                $arrField = $dc['fields'][$vv];
                            } else {
                                continue;
                            }
                        }

                        $arrFields[$vv] = $arrField;

                        // orderSRC support
                        if (isset($arrField['eval']['orderField'])) {
                            $arrFields[$arrField['eval']['orderField']] = $GLOBALS['TL_DCA'][$table]['fields'][$arrField['eval']['orderField']];
                        }
                    }
                }
            }

            // Unset a box if it does not contain any fields
            if (count($boxes[$k]) < $eCount) {
                unset($boxes[$k]);
            }
        }

        return $arrFields;
    }
}