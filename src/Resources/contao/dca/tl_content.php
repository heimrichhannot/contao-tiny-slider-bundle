<?php
$dc = &$GLOBALS['TL_DCA']['tl_content'];


/**
 * Palettes
 */
$dc['palettes']['tiny-slider-content-start']     = '{type_legend},type,headline;{tiny_slider_config},tinySliderConfig;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$dc['palettes']['tiny-slider-content-stop']      = '{type_legend},type,headline;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';
$dc['palettes']['tiny-slider-content-separator'] = '{type_legend},type,headline;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';