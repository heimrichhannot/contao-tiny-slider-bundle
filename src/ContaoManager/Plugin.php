<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use HeimrichHannot\ListBundle\HeimrichHannotContaoListBundle;
use HeimrichHannot\ReaderBundle\HeimrichHannotContaoReaderBundle;
use HeimrichHannot\TinySliderBundle\ContaoTinySliderBundle;
use Symfony\Component\Config\Loader\LoaderInterface;

class Plugin implements BundlePluginInterface, ConfigPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        $loadAfter = [ContaoCoreBundle::class];

        if (class_exists(HeimrichHannotContaoReaderBundle::class)) {
            $loadAfter[] = HeimrichHannotContaoReaderBundle::class;
        }

        if (class_exists(HeimrichHannotContaoListBundle::class)) {
            $loadAfter[] = HeimrichHannotContaoListBundle::class;
        }

        return [
            BundleConfig::create(ContaoTinySliderBundle::class)->setLoadAfter($loadAfter),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig): void
    {
        $loader->load(__DIR__.'/../Resources/config/services.yml');
    }
}
