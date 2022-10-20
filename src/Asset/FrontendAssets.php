<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Asset;

use HeimrichHannot\EncoreContracts\PageAssetsTrait;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class FrontendAssets implements ServiceSubscriberInterface
{
    use PageAssetsTrait;

    /**
     * Setup the frontend assets needed for tiny slider bundle.
     */
    public function addFrontendAssets()
    {
        $this->addPageEntrypoint('contao-tiny-slider-bundle', [
            'TL_CSS' => [
                'tiny-slider' => 'bundles/contaotinyslider/tiny-slider.css',
                'contao-tiny-slider-bundle' => 'bundles/contaotinyslider/contao-tiny-slider-bundle-theme.css',
            ],
            'TL_JAVASCRIPT' => [
                'tiny-slider' => 'bundles/contaotinyslider/tiny-slider.js',
                'contao-tiny-slider-bundle' => 'bundles/contaotinyslider/contao-tiny-slider-bundle.js',
            ],
        ]);
    }
}
