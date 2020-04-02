<?php

$dca = &$GLOBALS['TL_DCA']['tl_reader_config_element'];

System::getContainer()->get('huh.utils.dca')->loadLanguageFile('tl_tiny_slider_spread');

/**
 * Fields
 */
$fields = [
    'tinySliderSortBy'                     => [
        'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderSortBy'],
        'exclude'   => true,
        'inputType' => 'select',
        'options'   => ['custom', 'name_asc', 'name_desc', 'date_asc', 'date_desc', 'random'],
        'reference' => &$GLOBALS['TL_LANG']['tl_content'],
        'eval'      => ['tl_class' => 'w50', 'mandatory' => true],
        'sql'       => "varchar(32) NOT NULL default ''",
    ],
];

$dca['fields'] = array_merge(is_array($dca['fields']) ? $dca['fields'] : [], $fields);
