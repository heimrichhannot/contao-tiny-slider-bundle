<?php

use HeimrichHannot\TinySliderBundle\Backend\Hooks;
use HeimrichHannot\TinySliderBundle\DataContainer\TinySliderSpreadContainer;
use HeimrichHannot\TinySliderBundle\Element\ContentGallery;
use HeimrichHannot\TinySliderBundle\Element\ContentSeparator;
use HeimrichHannot\TinySliderBundle\Element\ContentStart;
use HeimrichHannot\TinySliderBundle\Element\ContentStop;
use HeimrichHannot\TinySliderBundle\EventListener\LoadDataContainerListener;
use HeimrichHannot\TinySliderBundle\EventListener\LoadLanguageFileListener;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;

/**
 * Constants
 */
/** @deprecated Use TinySliderSpreadContainer::PALETTE_DEFAULT instead */
define('TINY_SLIDER_PALETTE_DEFAULT', TinySliderSpreadContainer::PALETTE_DEFAULT);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_CONFIG_BASE instead */
define('TINY_SLIDER_PALETTE_CONFIG_BASE', TinySliderSpreadContainer::PALETTE_CONFIG_BASE);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_CONFIG_RESPONSIVE instead */
define('TINY_SLIDER_PALETTE_CONFIG_RESPONSIVE', TinySliderSpreadContainer::PALETTE_CONFIG_RESPONSIVE);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_PRESETCONFIG instead */
define('TINY_SLIDER_PALETTE_PRESETCONFIG', TinySliderSpreadContainer::PALETTE_PRESETCONFIG);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_GALLERY instead */
define('TINY_SLIDER_PALETTE_GALLERY', TinySliderSpreadContainer::PALETTE_GALLERY);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_CONTENT instead */
define('TINY_SLIDER_PALETTE_CONTENT', TinySliderSpreadContainer::PALETTE_CONTENT);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_CONTENT_SLIDER_START instead */
define('TINY_SLIDER_PALETTE_CONTENT_SLIDER_START', TinySliderSpreadContainer::PALETTE_CONTENT_SLIDER_START);
/** @deprecated Use TinySliderSpreadContainer::PALETTE_CONTENT_SLIDER_END instead */
define('TINY_SLIDER_PALETTE_CONTENT_SLIDER_END', TinySliderSpreadContainer::PALETTE_CONTENT_SLIDER_END);

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = [Hooks::class, 'loadDataContainerHook'];
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = [LoadDataContainerListener::class, 'onLoadDataContainer'];
$GLOBALS['TL_HOOKS']['loadLanguageFile'][] = [LoadLanguageFileListener::class, '__invoke'];

/**
 * Supported TL_DCA Entities, spreading efa palette to
 */
// News support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_module']['tiny-slider_newslist'] = 'type;[['.TinySliderSpreadContainer::PALETTE_PRESETCONFIG.']]';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_news_archive']['default']        = '[['.TinySliderSpreadContainer::PALETTE_PRESETCONFIG.']]{comments_legend';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_news']['default']                = '[['.TinySliderSpreadContainer::PALETTE_GALLERY.']]{enclosure_legend';

// Event support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_module']['tiny-slider_eventlist'] = 'type;[['.TinySliderSpreadContainer::PALETTE_PRESETCONFIG.']]';

// Content support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_content']['tiny-slider-gallery']       = '[['.TinySliderSpreadContainer::PALETTE_CONTENT.']]';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_content']['tiny-slider-content-start'] = '[['.TinySliderSpreadContainer::PALETTE_CONTENT_SLIDER_START.']]';

// Carousel config support
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_tiny_slider_config']['default'] = 'title;[['. TinySliderSpreadContainer::PALETTE_CONFIG_BASE.']]';
$GLOBALS['TL_TINY_SLIDER']['SUPPORTED']['tl_tiny_slider_config']['responsive'] = 'title;[['.TinySliderSpreadContainer::PALETTE_CONFIG_RESPONSIVE.']]';

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
            'tiny-slider-gallery'           => ContentGallery::class,
            'tiny-slider-content-start'     => ContentStart::class,
            'tiny-slider-content-separator' => ContentSeparator::class,
            'tiny-slider-content-stop'      => ContentStop::class,
        ],
    ]
);

/**
 * Assets
 */
if (System::getContainer()->get('huh.utils.container')->isFrontend()) {
    $GLOBALS['TL_CSS']['tiny-slider']        = 'assets/tiny-slider/tiny-slider/dist/tiny-slider.css|static';
    $GLOBALS['TL_JAVASCRIPT']['tiny-slider'] = 'assets/tiny-slider/tiny-slider/dist/min/tiny-slider.js|static';
    $GLOBALS['TL_JAVASCRIPT']['contao-tiny-slider-bundle'] = 'bundles/contaotinyslider/js/contao-tiny-slider-bundle.js|static';
}

/**
 * Intend elements
 */
$GLOBALS['TL_WRAPPERS']['start'][]     = 'tiny-slider-content-start';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'tiny-slider-content-stop';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'tiny-slider-content-separator';

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_tiny_slider_config'] = TinySliderConfigModel::class;
