<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Asset;

use HeimrichHannot\EncoreContracts\EncoreEntry;
use HeimrichHannot\TinySliderBundle\HeimrichHannotContaoTinySliderBundle;

class EncoreExtension implements \HeimrichHannot\EncoreContracts\EncoreExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundle(): string
    {
        return HeimrichHannotContaoTinySliderBundle::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntries(): array
    {
        return [
            EncoreEntry::create('contao-tiny-slider-bundle', 'src/Resources/assets/js/contao-tiny-slider-bundle.js')
                ->setRequireCss(true)
                ->addCssEntryToRemoveFromGlobals('tiny-slider')
                ->addCssEntryToRemoveFromGlobals('contao-tiny-slider-bundle')
                ->addJsEntryToRemoveFromGlobals('tiny-slider')
                ->addJsEntryToRemoveFromGlobals('contao-tiny-slider-bundle'),
            EncoreEntry::create('contao-tiny-slider-bundle', 'src/Resources/assets/js/contao-tiny-slider-bundle-theme.js')
                ->setRequireCss(true),
        ];
    }
}
