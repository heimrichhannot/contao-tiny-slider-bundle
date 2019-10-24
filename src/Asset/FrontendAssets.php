<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
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
        $this->container     = $container;
        $this->containerUtil = $containerUtil;
    }

    /**
     * Setup the frontend assets needed for tiny slider bundle
     */
    public function addFrontendAssets()
    {
        if ($this->containerUtil->isFrontend())
        {
            if ($this->container->has('huh.encore.asset.frontend'))
            {
                $this->container->get('huh.encore.asset.frontend')->addActiveEntrypoint('contao-tiny-slider-bundle');
                $this->container->get('huh.encore.asset.frontend')->addActiveEntrypoint('contao-tiny-slider-bundle-theme');
            }

            $GLOBALS['TL_CSS']['tiny-slider']        = 'assets/tiny-slider/tiny-slider/dist/tiny-slider.css|static';
            $GLOBALS['TL_JAVASCRIPT']['tiny-slider'] = 'assets/tiny-slider/tiny-slider/dist/min/tiny-slider.js|static';
            $GLOBALS['TL_JAVASCRIPT']['contao-tiny-slider-bundle'] = 'bundles/contaotinyslider/contao-tiny-slider-bundle.js|static';
        }
    }
}