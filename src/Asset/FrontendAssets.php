<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Asset;

use HeimrichHannot\EncoreContracts\PageAssetsTrait;
use HeimrichHannot\UtilsBundle\Util\Utils;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class FrontendAssets implements ServiceSubscriberInterface
{
    use PageAssetsTrait;

    private Utils $utils;

    public function __construct(Utils $utils)
    {
        $this->utils = $utils;
    }

    /**
     * Setup the frontend assets needed for tiny slider bundle.
     */
    public function addFrontendAssets()
    {
        if (!$this->utils->container()->isFrontend()) {
            return;
        }
        $this->addPageEntrypoint('contao-tiny-slider-bundle', [
            'TL_CSS' => [
                'tiny-slider' => 'bundles/contaotinyslider/tiny-slider.css',
            ],
            'TL_JAVASCRIPT' => [
                'tiny-slider' => 'bundles/contaotinyslider/tiny-slider.js',
                'contao-tiny-slider-bundle' => 'bundles/contaotinyslider/contao-tiny-slider-bundle.js',
            ],
        ]);
        $this->addPageEntryPoint('contao-tiny-slider-bundle-theme', [
            'TL_CSS' => [
                'contao-tiny-slider-bundle' => 'bundles/contaotinyslider/contao-tiny-slider-bundle-theme.css',
            ],
        ]);
    }
}
