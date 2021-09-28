<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

$lang = &$GLOBALS['TL_LANG']['tl_tiny_slider_spread'];

/*
 * Fields
 */
$lang['tinySliderConfig'] = ['Tiny slider configuration', 'Choose a tiny slider configuration from the list.'];
$lang['addTinySlider'] = ['Add tiny slider', 'Add tiny slider support'];
$lang['addGallery'] = ['Add gallery', 'Add an image gallery.'];
$lang['tinySliderMultiSRC'] = ['Source files', 'Please select one or more files or folders from the files directory. If you select a folder, its files will be included automatically.'];
$lang['tinySliderOrderSRC'] = ['Sort order', 'The sort order of the items.'];
$lang['tinySliderSortBy'] = ['Order by', 'Please choose the sort order.'];
$lang['tinySliderUseHomeDir'] = ['Use home directory', 'Use the home directory as file source if there is an authenticated user.'];
$lang['tinySliderSize'] = ['Image size', 'Here you can set the image dimensions and the resize mode.'];
$lang['tinySliderFullsize'] = ['Full-size view/new window', 'Open the full-size image in a lightbox or the link in a new browser window.'];
$lang['tinySliderNumberOfItems'] = ['Total number of images', 'Here you can limit the total number of images. Set to 0 to show all.'];
$lang['tinySliderCustomTpl'] = ['Custom element template', 'Here you can overwrite the default element template.'];
$lang['tinySlider_mode'] = ['Mode', 'Controls animation behaviour. With carousel everything slides to the side, while gallery uses fade animations and changes all slides at once. Default: `carousel`'];
$lang['tinySlider_axis'] = ['Axis', 'The axis of the slider. Default: `horizontal`'];
$lang['tinySlider_items'] = ['Items', 'Number of slides being displayed in the viewport. If slides less than `items`, the slider won\'t be initialized. Default: 1'];
$lang['tinySlider_gutter'] = ['Gutter', 'Space between slides (in "px"). Default: 0'];
$lang['tinySlider_edgePadding'] = ['Edge-Padding', 'Space on the outside (in "px"). Default: 0'];
$lang['tinySlider_fixedWidth'] = ['Fixed width', 'Controls width attribute of the slides. Default: false'];
$lang['tinySlider_autoWidth'] = ['Auto width', 'If `true`, the width of each slide will be its natural width as a `inline-block` box. Default: false'];
$lang['tinySlider_viewportMax'] = ['Maximum viewport width', 'Maximum viewport width for `fixedWidth`/`autoWidth`. Default: false'];
$lang['tinySlider_slideBy'] = ['Slide by', 'Number of slides going on one "click". Default: 1'];
$lang['tinySlider_center'] = ['Center', 'Center the active slide in the viewport. Default: false'];
$lang['tinySlider_controls'] = ['Controls', 'Controls the display and functionalities of controls components (prev/next buttons). If true, display the controls and add all functionalities. For better accessibility, when a prev/next button is focused, user will be able to control the slider using left/right arrow keys. Default: true'];
$lang['tinySlider_controlsTextPrev'] = ['Controls previous text', 'Text or markup in the prev buttons. Default: prev'];
$lang['tinySlider_controlsTextNext'] = ['Controls next text', 'Text or markup in the next buttons. Default: next'];
$lang['tinySlider_controlsPosition'] = ['Controls position', 'Controls controls position. Default: top'];
$lang['tinySlider_controlsContainer'] = ['Controls container', 'The container element/selector around the prev/next buttons. controlsContainer must have at least 2 child elements. Default: false'];
$lang['tinySlider_prevButton'] = ['Customized previous buttons', 'This option will be ignored if controlsContainer is a Node element or a CSS selector. Default: false'];
$lang['tinySlider_nextButton'] = ['Customized next buttons', 'This option will be ignored if controlsContainer is a Node element or a CSS selector. Default: false'];
$lang['tinySlider_nav'] = ['Navigation', 'Controls the display and functionalities of nav components (dots). If true, display the nav and add all functionalities. Default: true'];
$lang['tinySlider_navPosition'] = ['Navigation position', 'Controls nav position. Default: top'];
$lang['tinySlider_navContainer'] = ['Navigation container', 'The container element/selector around the dots. navContainer must have at least same number of children as the slides. Default: false'];
$lang['tinySlider_navAsThumbnails'] = ['Navigation as thumbnails', 'Indicates if the dots are thumbnails. If true, they will always be visible even when more than 1 slides displayed in the viewport. Default: false'];
$lang['tinySlider_arrowKeys'] = ['Arrow keys', 'Allows using arrow keys to switch slides. Default: false'];
$lang['tinySlider_speed'] = ['Slide animation speed', 'Speed of the slide animation (in "ms"). Default: 300'];
$lang['tinySlider_autoplay'] = ['Autoplay', 'Toggles the automatic change of slides. Default: false'];
$lang['tinySlider_autoplayPosition'] = ['Autoplay control position', 'Controls autoplay position. Default: top'];
$lang['tinySlider_autoplayTimeout'] = ['Autoplay timeout', 'Time between 2 autoplay slides change (in "ms"). Default: 5000'];
$lang['tinySlider_autoplayDirection'] = ['Autoplay direction', 'Direction of slide movement (ascending/descending the slide index). Default: forward'];
$lang['tinySlider_autoplayTextStart'] = ['Autoplay start text', 'Text or markup in the autoplay start button. Default: start'];
$lang['tinySlider_autoplayTextStop'] = ['Autoplay stop text', 'Text or markup in the autoplay stop button. Default: stop'];
$lang['tinySlider_autoplayHoverPause'] = ['Autoplay hover pause', 'Stops sliding on mouseover. Default: false'];
$lang['tinySlider_autoplayButton'] = ['Autoplay button', 'The customized autoplay start/stop button or selector. Default: false'];
$lang['tinySlider_autoplayButtonOutput'] = ['Autoplay button', 'Output autoplayButton markup when autoplay is true but a customized autoplayButton is not provided. Default: true'];
$lang['tinySlider_autoplayResetOnVisibility'] = ['Autoplay reset on visibility', 'Pauses the sliding when the page is invisiable and resumes it when the page become visible again. Default: true'];
$lang['tinySlider_animateIn'] = ['Intro animation', 'Name of intro animation class. Default: tns-fadeIn'];
$lang['tinySlider_animateOut'] = ['Outro animation', 'Name of outro animation class. Default: tns-fadeOut'];
$lang['tinySlider_animateNormal'] = ['Default animation', 'Name of default animation class. Default: tns-normal'];
$lang['tinySlider_animateDelay'] = ['Animation delay', 'Time between each gallery animation (in "ms"). Default: false'];
$lang['tinySlider_loop'] = ['Loop', 'Moves throughout all the slides seamlessly. Default: true'];
$lang['tinySlider_rewind'] = ['Rewind', 'Moves to the opposite edge when reaching the first or last slide. Default: false'];
$lang['tinySlider_autoHeight'] = ['Auto height', 'Height of slider container changes according to each slide\'s height. Default: false'];
$lang['tinySlider_responsive'] = ['Responsive', 'Enables settings sets at given screen width. Add additional breakpoints and settings. Default: null'];
$lang['tinySlider_responsive_breakpoint'] = ['Breakpoint', ''];
$lang['tinySlider_responsive_configuration'] = ['Configuration', ''];
$lang['tinySlider_lazyload'] = ['Lazy load', 'Enables lazyloading images that are currently not viewed, thus saving bandwidth. Class .tns-lazy-img need to be set on every image you want to lazyload if option lazyloadSelector is not specified. Default: true'];
$lang['tinySlider_lazyloadSelector'] = ['Lazy load selector', 'The CSS selector for lazyload images. Default: .tns-lazy-img'];
$lang['tinySlider_touch'] = ['Touch', 'Activates input detection for touch devices. Default: true'];
$lang['tinySlider_mouseDrag'] = ['Mouse drag', 'Changing slides by dragging them. Default: false'];
$lang['tinySlider_preventActionWhenRunning'] = ['Prevent action while transforming', 'Prevent next transition while slider is transforming. Default: false'];
$lang['tinySlider_preventScrollOnTouch'] = ['Prevent page from scrolling on touchmove.', 'Prevent page from scrolling on touchmove. If set to "auto", the slider will first check if the touch direction matches the slider axis, then decide whether prevent the page scrolling or not. If set to "force", the slider will always prevent the page scrolling. Default: auto'];
$lang['tinySlider_swipeAngle'] = ['Swipe angle', 'Swipe or drag will not be triggered if the angle is not inside the range when set. Default: 15'];
$lang['tinySlider_nested'] = ['Nested', 'Define the relationship between nested sliders. Make sure you run the inner slider first, otherwise the height of the inner slider container will be wrong. Default: false'];
$lang['tinySlider_freezable'] = ['Freezable', 'Indicate whether the slider will be frozen (controls, nav, autoplay and other functions will stop work) when all slides can be displayed in one page. Default: true'];
$lang['tinySlider_disable'] = ['Disable (tinySlider-property)', 'Disable slider. Default: false'];
$lang['tinySlider_skipInit'] = ['Skip initialization (TinySliderBundle-property)', 'Skip slider initialization. Default: false'];
$lang['tinySlider_startIndex'] = ['Initial index', 'The initial index of the slider. Default: 0'];
$lang['tinySlider_onInit'] = ['Init callback', 'Callback to be run on initialization. Default: false'];
$lang['tinySlider_useLocalStorage'] = ['Use local storage', 'Save browser capability variables to localStorage and without detecting them everytime the slider runs if set to true. Default: true'];
$lang['cssClass'] = ['CSS class', 'Here you can enter CSS classes seperated by space that will be added to the slider container.'];
$lang['tinySlider_enhanceAccessibility'] = ['Enhance accessibility', 'Make only active slider items tabbable. Disable tab to slide.'];
/*
 * Legends
 */
$lang['tiny_slider_legend'] = 'Tiny slider settings';
$lang['tiny_slider_gallery'] = 'Gallery settings';
$lang['tiny_slider_config'] = 'Tiny slider settings';

/*
 * Popup
 */
$lang['editTinySliderConfig'][0] = 'Edit tiny slider configuration';
$lang['editTinySliderConfig'][1] = 'Edit tiny slider configuration ID %s';
