<?php

/**
 * Constants
 */
define('TINY_SLIDER_PALETTE_DEFAULT', 'default');
define('TINY_SLIDER_PALETTE_CONFIG_BASE', 'flat');
define('TINY_SLIDER_PALETTE_CONFIG_RESPONSIVE', 'responsive');
define('TINY_SLIDER_PALETTE_PRESETCONFIG', 'presetConfig');
define('TINY_SLIDER_PALETTE_GALLERY', 'gallery');
define('TINY_SLIDER_PALETTE_CONTENT', 'tiny-slider');
define('TINY_SLIDER_PALETTE_CONTENT_SLIDER_START', 'tiny-slider-content-start');
define('TINY_SLIDER_PALETTE_CONTENT_SLIDER_END', 'tiny-slider-content-end');

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = ['HeimrichHannot\TinySliderBundle\Backend\Hooks', 'loadDataContainerHook'];

/**
 * Supported TL_DCA Entities, spreading efa palette to
 */
// News support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_module']['tiny-slider_newslist'] = 'type;[[TINY_SLIDER_PALETTE_PRESETCONFIG]]';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_news_archive']['default']        = '[[TINY_SLIDER_PALETTE_PRESETCONFIG]]{comments_legend';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_news']['default']                = '[[TINY_SLIDER_PALETTE_GALLERY]]{enclosure_legend';

// Event support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_module']['tiny-slider_eventlist'] = 'type;[[TINY_SLIDER_PALETTE_PRESETCONFIG]]';

// Content support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_content']['tiny-slider-gallery']       = '[[TINY_SLIDER_PALETTE_CONTENT]]';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_content']['tiny-slider-content-start'] = '[[TINY_SLIDER_PALETTE_CONTENT_SLIDER_START]]';

// Carousel config support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_tiny_slider_config']['default'] = 'title;[[TINY_SLIDER_PALETTE_CONFIG_BASE]]';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_tiny_slider_config']['responsive'] = 'title;[[TINY_SLIDER_PALETTE_CONFIG_RESPONSIVE]]';

/**
 * Back end modules
 */
array_insert(
    $GLOBALS['BE_MOD']['system'],
    1,
    [

        'tiny_slider_config' => [
            'tables' => ['tl_tiny_slider_config'],
        ],
    ]
);

/**
 * Content elements
 */
array_insert(
    $GLOBALS['TL_CTE'],
    3,
    [
        'tiny-slider' => [
            'tiny-slider-gallery'           => 'HeimrichHannot\TinySliderBundle\Element\ContentGallery',
            'tiny-slider-content-start'     => 'HeimrichHannot\TinySliderBundle\Element\ContentStart',
            'tiny-slider-content-separator' => 'HeimrichHannot\TinySliderBundle\Element\ContentSeparator',
            'tiny-slider-content-stop'      => 'HeimrichHannot\TinySliderBundle\Element\ContentStop',
            'tiny-slider-nav-start'         => 'HeimrichHannot\TinySliderBundle\Element\ContentNavStart',
            'tiny-slider-nav-separator'     => 'HeimrichHannot\TinySliderBundle\Element\ContentNavSeparator',
            'tiny-slider-nav-stop'          => 'HeimrichHannot\TinySliderBundle\Element\ContentNavStop',
        ],
    ]
);

/**
 * Intend elements
 */
$GLOBALS['TL_WRAPPERS']['start'][]     = 'tiny-slider-content-start';
$GLOBALS['TL_WRAPPERS']['start'][]     = 'tiny-slider-nav-start';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'tiny-slider-content-stop';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'tiny-slider-nav-stop';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'tiny-slider-content-separator';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'tiny-slider-nav-separator';

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_tiny_slider_config'] = 'HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel';