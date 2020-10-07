<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\DataContainer;

use Contao\Backend;
use Contao\DataContainer;

class TinySliderSpreadContainer
{
    const PALETTE_DEFAULT = 'default';
    const PALETTE_PRESETCONFIG = 'presetConfig';
    const PALETTE_GALLERY = 'gallery';
    const PALETTE_CONTENT = 'tiny-slider';
    const PALETTE_CONTENT_SLIDER_START = 'tiny-slider-content-start';
    const PALETTE_CONTENT_SLIDER_END = 'tiny-slider-content-end';
    const PALETTE_CONFIG_RESPONSIVE = 'responsive';
    const PALETTE_CONFIG_BASE = 'flat';

    /**
     * @param DataContainer $dc
     */
    public function onTinySliderCustomTplOptionsCallback($dc)
    {
        return Backend::getTemplateGroup('ce_' . $dc->activeRecord->type);
    }
}
