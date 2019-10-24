<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
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
        }
    }

    protected function addConfigElementFields(string $table)
    {
        $dca = &$GLOBALS['TL_DCA'][$table];

        $dca['fields']['tinySliderConfig'] = [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderConfig'],
            'inputType'        => 'select',
            'exclude'          => true,
            'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getBaseConfigurations'],
            'sql'              => "int(10) unsigned NOT NULL default '0'",
            'eval'             => ['tl_class' => 'w50'],
            'wizard'           => [
                ['huh.tiny_slider.backend.tiny_slider_spread', 'editTinySliderConfig'],
            ],
        ];
    }
}