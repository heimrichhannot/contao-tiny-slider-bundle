<?php

/**
 * Table tl_slick_config
 */

$GLOBALS['TL_DCA']['tl_tiny_slider_config'] = [

    // Config
    'config'   => [
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    // List
    'list'     => [
        'sorting'           => [
            'mode'        => 2,
            'panelLayout' => 'filter,sort;search,limit',
            'fields'      => ['type'],
        ],
        'label'             => [
            'fields' => ['title', 'type'],
            'format' => '%s',
        ],
        'global_operations' => [
            'all' => [
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"',
            ],
        ],
        'operations'        => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_config']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif',
            ],
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_config']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif',
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_tiny_slider_config']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\''.$GLOBALS['TL_LANG']['MSC']['deleteConfirm'].'\'))return false;Backend.getScrollOffset()"',
            ],
            'show'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_config']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif',
            ],
        ],
    ],

    // Palettes
    'palettes' => [
        '__selector__' => ['type'],
        'default'      => '{title_legend},type,title;',
        'responsive'   => '{title_legend},type,title;',
    ],

    // Fields
    'fields'   => [
        'id'      => [
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],
        'tstamp'  => [
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
        'type'    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_config']['type'],
            'exclude'   => true,
            'search'    => true,
            'flag'      => 12,
            'sorting'   => true,
            'default'   => 'base',
            'inputType' => 'select',
            'options'   => ['base', 'responsive'],
            'reference' => $GLOBALS['TL_LANG']['tl_tiny_slider_config']['reference']['type'],
            'eval'      => ['mandatory' => true, 'submitOnChange' => true],
            'sql'       => "varchar(12) NOT NULL default ''",
        ],
        'title'   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_config']['title'],
            'flag'      => 1,
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 255],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
    ],
];
