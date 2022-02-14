<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle;

class DcaFieldGenerator
{
    public static function addTinySliderConfigSelect(?array &$dca): void
    {
        $dca['fields']['tinySliderConfig'] = [
            'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderConfig'],
            'inputType' => 'select',
            'exclude' => true,
            'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getBaseConfigurations'],
            'wizard' => [['huh.tiny_slider.backend.tiny_slider_spread', 'editTinySliderConfig']],
            'filter' => true,
            'eval' => ['tl_class' => 'w50', 'mandatory' => true],
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ];
    }

    public static function addAddTinySliderCheckbox(array &$dca)
    {
        $dca['fields']['addTinySlider'] = [
            'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['addTinySlider'],
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
            'sql' => "char(1) NOT NULL default ''",
        ];
    }

    public static function addTinySliderSortBySelect(array &$dca)
    {
        $dca['fields']['tinySliderSortBy'] = [
            'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderSortBy'],
            'exclude' => true,
            'inputType' => 'select',
            'options' => ['custom', 'name_asc', 'name_desc', 'date_asc', 'date_desc', 'random'],
            'reference' => &$GLOBALS['TL_LANG']['tl_content'],
            'eval' => ['tl_class' => 'w50', 'mandatory' => true],
            'sql' => "varchar(32) NOT NULL default ''",
        ];
    }
}
