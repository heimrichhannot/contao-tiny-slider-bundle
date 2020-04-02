<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Asset;

use HeimrichHannot\UtilsBundle\Container\ContainerUtil;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FrontendAssets
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var ContainerUtil
     */
    private $containerUtil;

    /**
     * FrontendAssets constructor.
     */
    public function __construct(ContainerInterface $container, ContainerUtil $containerUtil)
    {
        $this->container = $container;
        $this->containerUtil = $containerUtil;
    }

    /**
     * Setup the frontend assets needed for tiny slider bundle.
     */
    public function addFrontendAssets()
    {
        if ($this->containerUtil->isFrontend()) {
            if ($this->container->has('huh.encore.asset.frontend')) {
                $this->container->get('huh.encore.asset.frontend')->addActiveEntrypoint('contao-tiny-slider-bundle');
                $this->container->get('huh.encore.asset.frontend')->addActiveEntrypoint('contao-tiny-slider-bundle-theme');
            }

            $GLOBALS['TL_CSS']['tiny-slider'] = 'bundles/contaotinyslider/tiny-slider.css';
            $GLOBALS['TL_JAVASCRIPT']['tiny-slider'] = 'bundles/contaotinyslider/tiny-slider.js';
            $GLOBALS['TL_CSS']['contao-tiny-slider-bundle'] = 'bundles/contaotinyslider/contao-tiny-slider-bundle-theme.css';
            $GLOBALS['TL_JAVASCRIPT']['contao-tiny-slider-bundle'] = 'bundles/contaotinyslider/contao-tiny-slider-bundle.js';
        }
    }
}
