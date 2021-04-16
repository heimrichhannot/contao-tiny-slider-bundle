<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\EventListener;

use Contao\Controller;
use HeimrichHannot\TinySliderBundle\DcaFieldGenerator;

class LoadDataContainerListener
{
    public function onLoadDataContainer(string $table)
    {
        switch ($table) {
            case 'tl_reader_config_element':
            case 'tl_list_config_element':
                $this->addConfigElementFields($table);

                return;

            case 'tl_list_config':
                $this->addListConfigDcaFields();

                return;
        }
    }

    /**
     * Add field to config type tables.
     */
    protected function addConfigElementFields(string $table)
    {
        Controller::loadLanguageFile('tinySliderConfig');
        $dca = &$GLOBALS['TL_DCA'][$table];
        DcaFieldGenerator::addTinySliderConfigSelect($dca);
        DcaFieldGenerator::addTinySliderSortBySelect($dca);
    }

    /**
     * Add fields to tl_list_config if list bundle is installed.
     */
    protected function addListConfigDcaFields()
    {
        Controller::loadLanguageFile('tinySliderConfig');
        $dca = &$GLOBALS['TL_DCA']['tl_list_config'];
        $dca['palettes']['default'] = str_replace('addMasonry', 'addMasonry,addTinySlider', $dca['palettes']['default']);
        $dca['palettes']['__selector__'][] = 'addTinySlider';
        $dca['subpalettes']['addTinySlider'] = 'tinySliderConfig';

        DcaFieldGenerator::addAddTinySliderCheckbox($dca);
        DcaFieldGenerator::addTinySliderConfigSelect($dca);

        \HeimrichHannot\ListBundle\Backend\ListConfig::addOverridableFields();
    }
}
