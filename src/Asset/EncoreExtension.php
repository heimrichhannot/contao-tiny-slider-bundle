<?php

/*
 * Copyright (c) 2023 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Asset;

use HeimrichHannot\EncoreContracts\EncoreEntry;
use HeimrichHannot\EncoreContracts\EncoreExtensionInterface;
use HeimrichHannot\TinySliderBundle\ContaoTinySliderBundle;

class EncoreExtension implements EncoreExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundle(): string
    {
        return ContaoTinySliderBundle::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntries(): array
    {
        return [
            EncoreEntry::create('contao-tiny-slider-bundle', 'src/Resources/assets/js/contao-tiny-slider-bundle.js')
                ->setRequiresCss(true)
                ->addCssEntryToRemoveFromGlobals('tiny-slider')
                ->addCssEntryToRemoveFromGlobals('contao-tiny-slider-bundle')
                ->addJsEntryToRemoveFromGlobals('tiny-slider')
                ->addJsEntryToRemoveFromGlobals('contao-tiny-slider-bundle'),
            EncoreEntry::create('contao-tiny-slider-bundle-theme', 'src/Resources/assets/js/contao-tiny-slider-bundle-theme.js')
                ->setRequiresCss(true),
        ];
    }
}
