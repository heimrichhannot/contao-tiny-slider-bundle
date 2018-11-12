<?php

// reusable palettes extension for tl_news, tl_content, tl_module etc
$GLOBALS['TL_DCA']['tl_tiny_slider_spread'] = [
    'palettes'    => [
        '__selector__'                        => ['addTinySlider', 'addGallery', 'tinySlider_pausePlay'],
        TINY_SLIDER_PALETTE_DEFAULT           => '{tiny_slider_legend},addTinySlider;',
        TINY_SLIDER_PALETTE_PRESETCONFIG      => '{tiny_slider_config},tinySliderConfig;',
        TINY_SLIDER_PALETTE_GALLERY           => '{tiny_slider_gallery},addGallery;',
        TINY_SLIDER_PALETTE_CONTENT           => '{type_legend},type,headline;{tiny_slider_config},tinySliderConfig;{source_legend},multiSRC,sortBy,useHomeDir;{image_legend},size,fullsize,numberOfItems;{template_legend:hide},tinySliderGalleryTpl,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop',
        TINY_SLIDER_PALETTE_CONFIG_RESPONSIVE => '{tiny_slider_config},tinySlider_items,tinySlider_slideBy,tinySlider_speed,tinySlider_autoHeight,tinySlider_fixedWidth,tinySlider_edgePadding,tinySlider_gutter,tinySlider_controls,tinySlider_controlsTextPrev,tinySlider_controlsTextNext,tinySlider_nav,tinySlider_autoplay,tinySlider_autoplayHoverPause,tinySlider_autoplayResetOnVisibility,tinySlider_autoplayTextStart,tinySlider_autoplayTextStop,tinySlider_autoplayTimeout,tinySlider_touch,tinySlider_mouseDrag,tinySlider_arrowKeys,tinySlider_disable,tinySlider_startIndex;',
    ],
    'subpalettes' => [
        'addTinySlider'        => '
                            tinySlider_mode,
                            tinySlider_axis,
                            tinySlider_items,
                            tinySlider_gutter,
                            tinySlider_edgePadding,
                            tinySlider_fixedWidth,
                            tinySlider_autoWidth,
                            tinySlider_viewportMax,
                            tinySlider_slideBy,
                            tinySlider_controls,
                            tinySlider_controlsPosition,
                            tinySlider_controlsTextPrev,
                            tinySlider_controlsTextNext,
                            tinySlider_controlsContainer,
                            tinySlider_prevButton,
                            tinySlider_nextButton,
                            tinySlider_nav,
                            tinySlider_navPosition,
                            tinySlider_navContainer,
                            tinySlider_navAsThumbnails,
                            tinySlider_arrowKeys,
                            tinySlider_speed,
                            tinySlider_autoplay,
                            tinySlider_autoplayPosition,
                            tinySlider_autoplayTimeout,
                            tinySlider_autoplayDirection,
                            tinySlider_autoplayTextStart,
                            tinySlider_autoplayTextStop,
                            tinySlider_autoplayHoverPause,
                            tinySlider_autoplayButton,
                            tinySlider_autoplayButtonOutput,
                            tinySlider_autoplayResetOnVisibility,
                            tinySlider_animateIn,
                            tinySlider_animateOut,
                            tinySlider_animateNormal,
                            tinySlider_animateDelay,
                            tinySlider_loop,
                            tinySlider_rewind,
                            tinySlider_autoHeight,
                            tinySlider_lazyload,
                            tinySlider_lazyloadSelector,
                            tinySlider_touch,
                            tinySlider_mouseDrag,
                            tinySlider_preventActionWhenRunning,
                            tinySlider_preventScrollOnTouch,
                            tinySlider_swipeAngle,
                            tinySlider_nested,
                            tinySlider_freezable,
                            tinySlider_disable,
                            tinySlider_useLocalStorage,
                            tinySlider_responsive,
                            tinySlider_startIndex,
                            tinySlider_onInit,
							cssClass
							',
        'addGallery'           => 'tinySliderMultiSRC,tinySliderSortBy,tinySliderUseHomeDir,tinySliderSize,tinySliderFullsize,tinySliderNumberOfItems,tinySliderGalleryTpl,tinySliderCustomTpl',
        'tinySlider_pausePlay' => 'tinySlider_pauseButton, tinySlider_playButton',
    ],
    'fields'      => [
        'tinySliderConfig'                     => [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderConfig'],
            'inputType'        => 'select',
            'exclude'          => true,
            'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getBaseConfigurations'],
            'sql'              => "int(10) unsigned NOT NULL default '0'",
            'eval'             => ['tl_class' => 'w50'],
            'wizard'           => [
                ['huh.tiny_slider.backend.tiny_slider_spread', 'editTinySliderConfig'],
            ],
        ],
        'addTinySlider'                        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['addTinySlider'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'submitOnChange' => true,
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        // START: Gallery fields
        'addGallery'                           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['addGallery'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'submitOnChange' => true,
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySliderMultiSRC'                   => [
            'label'         => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderMultiSRC'],
            'exclude'       => true,
            'inputType'     => 'fileTree',
            'eval'          => ['multiple' => true, 'fieldType' => 'checkbox', 'orderField' => 'tinySliderOrderSRC', 'files' => true, 'mandatory' => true],
            'sql'           => "blob NULL",
            'load_callback' => [
                ['tl_content', 'setMultiSrcFlags'],
            ],
        ],
        'tinySliderOrderSRC'                   => [
            'label' => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderOrderSRC'],
            'sql'   => "blob NULL",
        ],
        'tinySliderSortBy'                     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderSortBy'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => ['custom', 'name_asc', 'name_desc', 'date_asc', 'date_desc', 'random'],
            'reference' => &$GLOBALS['TL_LANG']['tl_content'],
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "varchar(32) NOT NULL default ''",
        ],
        'tinySliderUseHomeDir'                 => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderUseHomeDir'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySliderSize'                       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderSize'],
            'exclude'   => true,
            'inputType' => 'imageSize',
            'options'   => System::getContainer()->get('contao.image.image_sizes')->getAllOptions(),
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval'      => ['rgxp' => 'natural', 'includeBlankOption' => true, 'nospace' => true, 'helpwizard' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(64) NOT NULL default ''",
        ],
        'tinySliderFullsize'                   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderFullsize'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50 m12'],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySliderNumberOfItems'              => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderNumberOfItems'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'natural', 'tl_class' => 'w50'],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySliderCustomTpl'                  => [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderCustomTpl'],
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => ['tl_content', 'getElementTemplates'],
            'eval'             => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
            'sql'              => "varchar(64) NOT NULL default ''",
        ],
        'tinySliderGalleryTpl'                 => [
            'label'            => &$GLOBALS['TL_LANG']['tl_content']['galleryTpl'],
            'exclude'          => true,
            'inputType'        => 'select',
            'default'          => 'tiny_slider_gallery_default',
            'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getGalleryTemplates'],
            'eval'             => ['tl_class' => 'w50'],
            'sql'              => "varchar(64) NOT NULL default ''",
        ],
        // END: Gallery fields
        // START: Tiny slider JS defaults / options
        'tinySlider_mode'                      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_mode'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 'carousel',
            'options'   => ['carousel', 'gallery'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(8) NOT NULL default ''",
        ],
        'tinySlider_axis'                      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_axis'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 'horizontal',
            'options'   => ['horizontal', 'vertical'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(10) NOT NULL default ''",
        ],
        'tinySlider_items'                     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_items'],
            'inputType' => 'text',
            'default'   => 1,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_gutter'                    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_gutter'],
            'inputType' => 'text',
            'default'   => 0,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_edgePadding'               => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_edgePadding'],
            'inputType' => 'text',
            'default'   => 0,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_fixedWidth'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_fixedWidth'],
            'inputType' => 'text',
            'default'   => 0,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_autoWidth'                 => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoWidth'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_viewportMax'               => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_viewportMax'],
            'inputType' => 'text',
            'default'   => 0,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_slideBy'                   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_slideBy'],
            'inputType' => 'text',
            'default'   => 1,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_controls'                  => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_controls'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_controlsPosition'          => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_controlsPosition'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 'top',
            'options'   => ['top', 'bottom'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(6) NOT NULL default ''",
        ],
        'tinySlider_controlsTextPrev'          => [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderControlsTextPrev'],
            'exclude'          => true,
            'inputType'        => 'select',
            'default'          => 'huh.tiny_slider.prev.default',
            'options_callback' => function (\DataContainer $dc) {
                return \Contao\System::getContainer()->get('huh.utils.choice.message')->getCachedChoices('huh.tiny_slider.prev');
            },
            'eval'             => ['chosen' => true, 'maxlength' => 128, 'includeBlankOption' => true, 'tl_class' => 'w50', 'tinySliderArray' => ['controlsText' => 0]],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_controlsTextNext'          => [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySliderControlsTextPrev'],
            'exclude'          => true,
            'default'          => 'huh.tiny_slider.next.default',
            'inputType'        => 'select',
            'options_callback' => function (\DataContainer $dc) {
                return \Contao\System::getContainer()->get('huh.utils.choice.message')->getCachedChoices('huh.tiny_slider.next');
            },
            'eval'             => ['chosen' => true, 'maxlength' => 128, 'includeBlankOption' => true, 'tl_class' => 'w50', 'tinySliderArray' => ['controlsText' => 1]],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_controlsContainer'         => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_controlsContainer'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_prevButton'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_prevButton'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_nextButton'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_nextButton'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_nav'                       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_nav'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_navPosition'               => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_navPosition'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 'top',
            'options'   => ['top', 'bottom'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(6) NOT NULL default ''",
        ],
        'tinySlider_navContainer'              => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_navContainer'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_navAsThumbnails'           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_navAsThumbnails'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_arrowKeys'                 => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_arrowKeys'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_speed'                     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_speed'],
            'inputType' => 'text',
            'default'   => 300,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_autoplay'                  => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplay'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_autoplayPosition'          => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayPosition'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 'top',
            'options'   => ['top', 'bottom'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(6) NOT NULL default ''",
        ],
        'tinySlider_autoplayTimeout'           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayTimeout'],
            'inputType' => 'text',
            'default'   => 5000,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_autoplayDirection'         => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayDirection'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 'forward',
            'options'   => ['forward', 'backward'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(8) NOT NULL default ''",
        ],
        'tinySlider_autoplayTextStart'         => [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayTextStart'],
            'exclude'          => true,
            'inputType'        => 'select',
            'default'          => 'huh.tiny_slider.prev.default',
            'options_callback' => function (\DataContainer $dc) {
                return \Contao\System::getContainer()->get('huh.utils.choice.message')->getCachedChoices('huh.tiny_slider.start');
            },
            'eval'             => ['chosen' => true, 'maxlength' => 128, 'includeBlankOption' => true, 'tl_class' => 'w50', 'tinySliderArray' => ['autoplayText' => 0]],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_autoplayTextStop'          => [
            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayTextStop'],
            'exclude'          => true,
            'default'          => 'huh.tiny_slider.next.default',
            'inputType'        => 'select',
            'options_callback' => function (\DataContainer $dc) {
                return \Contao\System::getContainer()->get('huh.utils.choice.message')->getCachedChoices('huh.tiny_slider.stop');
            },
            'eval'             => ['chosen' => true, 'maxlength' => 128, 'includeBlankOption' => true, 'tl_class' => 'w50', 'tinySliderArray' => ['autoplayText' => 1]],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_autoplayHoverPause'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayHoverPause'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_autoplayButton'            => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayButton'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'clr w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_autoplayButtonOutput'      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayButtonOutput'],
            'inputType' => 'checkbox',
            'default'   => true,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_autoplayResetOnVisibility' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoplayResetOnVisibility'],
            'inputType' => 'checkbox',
            'default'   => true,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_animateIn'                 => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_animateIn'],
            'exclude'   => true,
            'default'   => 'tns-fadeIn',
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'clr w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_animateOut'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_animateOut'],
            'exclude'   => true,
            'default'   => 'tns-fadeIn',
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_animateNormal'             => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_animateNormal'],
            'exclude'   => true,
            'default'   => 'tns-normal',
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_animateDelay'              => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_animateDelay'],
            'inputType' => 'text',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_loop'                      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_loop'],
            'inputType' => 'checkbox',
            'default'   => true,
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_rewind'                    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_rewind'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_autoHeight'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_autoHeight'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_responsive'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_responsive'],
            'inputType' => 'multiColumnEditor',
            'exclude'   => true,
            'eval'      => [
                'tl_class'          => 'clr',
                'multiColumnEditor' => [
                    'fields' => [
                        'breakpoint'    => [
                            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_responsive_breakpoint'],
                            'exclude'   => true,
                            'inputType' => 'text',
                            'eval'      => [
                                'groupStyle' => 'width:100px',
                                'rgxp'       => 'digit',
                            ],
                        ],
                        'configuration' => [
                            'label'            => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_responsive_configuration'],
                            'inputType'        => 'select',
                            'options_callback' => ['huh.tiny_slider.backend.tiny_slider_spread', 'getResponsiveConfigurations'],
                            'eval'             => [
                                'groupStyle'         => 'width:400px',
                                'includeBlankOption' => true,
                            ],
                        ],
                    ],
                ],
            ],
            'sql'       => "blob NULL",
        ],
        'tinySlider_lazyload'                  => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_lazyload'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_lazyloadSelector'          => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_lazyloadSelector'],
            'exclude'   => true,
            'default'   => '.tns-lazy-img',
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'allowHtml' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'tinySlider_touch'                     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_touch'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_mouseDrag'                 => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_mouseDrag'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_preventActionWhenRunning'  => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_preventActionWhenRunning'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_preventScrollOnTouch'      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_preventScrollOnTouch'],
            'inputType' => 'select',
            'default'   => 'auto',
            'exclude'   => true,
            'options'   => ['auto', 'force'],
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "varchar(5) NOT NULL default ''",
        ],
        'tinySlider_swipeAngle'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_swipeAngle'],
            'inputType' => 'text',
            'exclude'   => true,
            'default'   => 15,
            'eval'      => [
                'tl_class' => 'clr w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_nested'                    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_nested'],
            'inputType' => 'select',
            'exclude'   => true,
            'options'   => ['inner', 'outer'],
            'eval'      => [
                'tl_class'           => 'w50',
                'includeBlankOption' => true,
            ],
            'sql'       => "varchar(8) NOT NULL default ''",
        ],
        'tinySlider_freezable'                 => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_freezable'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => [
                'tl_class' => 'clr w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_disable'                   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_disable'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_startIndex'                => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_startIndex'],
            'inputType' => 'text',
            'exclude'   => true,
            'default'   => 0,
            'eval'      => [
                'tl_class' => 'w50',
                'rgxp'     => 'digit',
            ],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'",
        ],
        'tinySlider_useLocalStorage'           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_useLocalStorage'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => [
                'tl_class' => 'w50',
            ],
            'sql'       => "char(1) NOT NULL default ''",
        ],
        'tinySlider_onInit'                    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['tinySlider_onInit'],
            'inputType' => 'text',
            'exclude'   => true,
            'eval'      => [
                'tl_class' => 'w50 clr',
            ],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        // END: Tiny slider JS defaults / options
        'cssClass'                             => [
            'label'     => &$GLOBALS['TL_LANG']['tl_tiny_slider_spread']['cssClass'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
    ],
];

// flat & responsive palette, renders widtout submitOnChange Field
$GLOBALS['TL_DCA']['tl_tiny_slider_spread']['palettes'][TINY_SLIDER_PALETTE_CONFIG_BASE] = str_replace('addTinySlider', $GLOBALS['TL_DCA']['tl_tiny_slider_spread']['subpalettes']['addTinySlider'], $GLOBALS['TL_DCA']['tl_tiny_slider_spread']['palettes']['default']);

// Gallery Support -- not tl_content type present, set isGallery as default for multiSRC
$GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields']['slickMultiSRC']['eval']['orderField'] = 'tinySliderOrderSRC';
$GLOBALS['TL_DCA']['tl_tiny_slider_spread']['fields']['slickMultiSRC']['eval']['isGallery']  = true;

// Content Support -- set isGallery by type
$GLOBALS['TL_DCA']['tl_content']['fields']['multiSRC']['load_callback'][] = ['huh.tiny_slider.backend.tiny_slider_spread', 'setFileTreeFlags'];