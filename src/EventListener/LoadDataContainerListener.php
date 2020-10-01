<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\EventListener;

class LoadDataContainerListener
{
    public function onLoadDataContainer(string $table)
    {
        switch ($table) {
            case 'tl_reader_config_element':
                $this->addConfigElementFields($table);

                return;

            case 'tl_list_config':
                $this->addListConfigDcaFields();

                return;
        }
    }

    protected function addConfigElementFields(string $table)
    {
        $dca = &$GLOBALS['TL_DCA'][$table];

        $dca['fields']['tinySliderConfig'] = [
            'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderConfig'],
            'inputType' => 'select',
            'exclude' => true,
            'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getBaseConfigurations'],
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'eval' => ['tl_class' => 'w50'],
            'wizard' => [
                ['huh.tiny_slider.backend.tiny_slider_spread', 'editTinySliderConfig'],
            ],
        ];
    }

    /**
     * Add fields to tl_list_config if list bundle is installed.
     */
    protected function addListConfigDcaFields()
    {
        $dca = &$GLOBALS['TL_DCA']['tl_list_config'];
        $dca['palettes']['default'] = str_replace('addMasonry', 'addMasonry,addTinySlider', $dca['palettes']['default']);
        $dca['palettes']['__selector__'][] = 'addTinySlider';
        $dca['subpalettes']['addTinySlider'] = 'tinySliderConfig';

        $fields = [
            'addTinySlider' => [
                'label' => &$GLOBALS['TL_LANG']['tl_list_config']['addTinySlider'],
                'exclude' => true,
                'inputType' => 'checkbox',
                'eval' => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
                'sql' => "char(1) NOT NULL default ''",
            ],
            'tinySliderConfig' => [
                'label' => &$GLOBALS['TL_LANG']['tl_list_config']['tinySliderConfig'],
                'exclude' => true,
                'filter' => true,
                'inputType' => 'select',
                'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getBaseConfigurations'],
                'eval' => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true],
                'sql' => "int(10) unsigned NOT NULL default '0'",
            ],
        ];

        $dca['fields'] = array_merge($fields, \is_array($dca['fields']) ? $dca['fields'] : []);

        \HeimrichHannot\ListBundle\Backend\ListConfig::addOverridableFields();
    }
}
