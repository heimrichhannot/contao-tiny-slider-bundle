<?php

/*
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Twig;

use HeimrichHannot\TinySliderBundle\Asset\FrontendAssets;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TinySliderExtension extends AbstractExtension implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Get list of twig filters.
     *
     * @return array|TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('tiny_slider_wrapper_class', [$this, 'getWrapperClass']),
            new TwigFilter('tiny_slider_container_attributes', [$this, 'getContainerAttributes']),
        ];
    }

    /**
     * Get tiny slider wrapper css class for given tiny slider config
     *
     * @param int $config Tiny slider config id
     *
     * @return string Wrapper css class
     */
    public function getWrapperClass(int $config = null): string
    {
        if (!$config) {
            return '';
        }

        $this->container->get(FrontendAssets::class)->addFrontendAssets();
        return $this->container->get('huh.tiny_slider.util.config')->getCssClass($config);
    }

    /**
     * Get tiny slider container data attributes for given tiny slider config
     * @param int|null $config
     * @param string $containerSelector
     * @return string Data attributes as string
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getContainerAttributes(int $config = null, string $containerSelector = '.tiny-slider-container'): string
    {
        if (!$config) {
            return '';
        }
        $this->container->get(FrontendAssets::class)->addFrontendAssets();
        return $this->container->get('huh.tiny_slider.util.config')->getAttributes($config, $containerSelector);
    }
}
