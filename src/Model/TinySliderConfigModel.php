<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Model;

use Contao\Model;

/**
 * Class TinySliderConfigModel
 * @package HeimrichHannot\TinySliderBundle\Model
 *
 * @property $id
 * @property $tstamp
 * @property $type
 * @property $title
 * @property $tinySlider_mode
 * @property $tinySlider_axis
 * @property $tinySlider_items
 * @property $tinySlider_gutter
 * @property $tinySlider_edgePadding
 * @property $tinySlider_fixedWidth
 * @property $tinySlider_autoWidth
 * @property $tinySlider_viewportMax
 * @property $tinySlider_slideBy
 * @property $tinySlider_controls
 * @property $tinySlider_controlsPosition
 * @property $tinySlider_controlsTextPrev
 * @property $tinySlider_controlsTextNext
 * @property $tinySlider_controlsContainer
 * @property $tinySlider_prevButton
 * @property $tinySlider_nextButton
 * @property $tinySlider_nav
 * @property $tinySlider_navPosition
 * @property $tinySlider_navContainer
 * @property $tinySlider_navAsThumbnails
 * @property $tinySlider_arrowKeys
 * @property $tinySlider_speed
 * @property $tinySlider_autoplay
 * @property $tinySlider_autoplayPosition
 * @property $tinySlider_autoplayTimeout
 * @property $tinySlider_autoplayDirection
 * @property $tinySlider_autoplayTextStart
 * @property $tinySlider_autoplayTextStop
 * @property $tinySlider_autoplayHoverPause
 * @property $tinySlider_autoplayButton
 * @property $tinySlider_autoplayButtonOutput
 * @property $tinySlider_autoplayResetOnVisibility
 * @property $tinySlider_animateIn
 * @property $tinySlider_animateOut
 * @property $tinySlider_animateNormal
 * @property $tinySlider_animateDelay
 * @property $tinySlider_loop
 * @property $tinySlider_rewind
 * @property $tinySlider_autoHeight
 * @property $tinySlider_lazyload
 * @property $tinySlider_lazyloadSelector
 * @property $tinySlider_touch
 * @property $tinySlider_mouseDrag
 * @property $tinySlider_preventActionWhenRunning
 * @property $tinySlider_preventScrollOnTouch
 * @property $tinySlider_swipeAngle
 * @property $tinySlider_nested
 * @property $tinySlider_freezable
 * @property $tinySlider_disable
 * @property $tinySlider_skipInit
 * @property $tinySlider_useLocalStorage
 * @property $tinySlider_responsive
 * @property $tinySlider_startIndex
 * @property $tinySlider_onInit
 * @property $cssClass
 */
class TinySliderConfigModel extends Model
{
    protected static $strTable = 'tl_tiny_slider_config';
}
