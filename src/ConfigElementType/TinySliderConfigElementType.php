<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\ConfigElementType;

use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementData;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementResult;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementTypeInterface;
use HeimrichHannot\TinySliderBundle\Asset\FrontendAssets;
use HeimrichHannot\TinySliderBundle\Frontend\Gallery;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;
use HeimrichHannot\TinySliderBundle\Util\Config;
use HeimrichHannot\UtilsBundle\Template\TemplateUtil;
use Twig\Environment;

class TinySliderConfigElementType implements ConfigElementTypeInterface
{
    /**
     * @var Config
     */
    protected $tsConfigUtil;
    /**
     * @var TemplateUtil
     */
    protected $templateUtil;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FrontendAssets
     */
    private $frontendAssets;

    public function __construct(Environment $twig, FrontendAssets $frontendAssets, Config $tsConfigUtil, TemplateUtil $templateUtil)
    {
        $this->twig = $twig;
        $this->frontendAssets = $frontendAssets;
        $this->tsConfigUtil = $tsConfigUtil;
        $this->templateUtil = $templateUtil;
    }

    /**
     * Return the reader config element type alias.
     */
    public static function getType(): string
    {
        return 'tiny_slider';
    }

    /**
     * Return the reader config element type palette.
     */
    public function getPalette(string $prependPalette, string $appendPalette): string
    {
        return $prependPalette
            .'{config_legend},tinySliderConfig,imageSelectorField,imageField,tinySliderSortBy,orderField,imgSize;'
            .$appendPalette;
    }

    public function applyConfiguration(ConfigElementData $configElementData): ConfigElementResult
    {
        $configuration = $configElementData->getConfiguration();
        $item = $configElementData->getItemData();

        if (!$configuration->tinySliderConfig || !($tinySliderConfig = TinySliderConfigModel::findByPk($configuration->tinySliderConfig))) {
            return new ConfigElementResult(ConfigElementResult::TYPE_NONE, null);
        }

        if (($imageSelectorField = $configuration->imageSelectorField) && !$item[$imageSelectorField] ||
            !($imageField = $configuration->imageField) || !$item[$imageField]) {
            return new ConfigElementResult(ConfigElementResult::TYPE_NONE, null);
        }

        $this->frontendAssets->addFrontendAssets();

        $config = [
            'tinySliderMultiSRC' => $item[$imageField],
            'tinySliderUseHomeDir' => $item['tinySliderUseHomeDir'],
            'tinySliderFullsize' => $item['tinySliderFullsize'],
            'tinySliderNumberOfItems' => $item['tinySliderNumberOfItems'],
            'tinySliderCustomTpl' => $item['tinySliderCustomTpl'],
            'tinySliderGalleryTpl' => $item['tinySliderGalleryTpl'],
            'tinySliderConfig' => $tinySliderConfig->id,
        ];

        if ($configuration->orderField && ($item[$configuration->orderField] ?? false)) {
            $config['tinySliderOrderSRC'] = $item[$configuration->orderField];
            $config['tinySliderSortBy'] = 'custom';
        } else {
            $config['tinySliderSortBy'] = $configuration->tinySliderSortBy;
        }

        if ($configuration->imgSize) {
            $config['tinySliderSize'] = $configuration->imgSize;
        } else {
            $config['tinySliderSize'] = $item['tinySliderSize'];
        }

        $gallery = new Gallery($this->tsConfigUtil->createSettings($config, $tinySliderConfig));
        $galleryImages = $gallery->getImages();
        $tinySliderGallery = [
            'html' => $this->templateUtil->renderTwigTemplate('tiny_slider_config_element', [
                'tinySliderSlides' => $galleryImages,
                'config' => $tinySliderConfig->id,
            ]),
            'images' => $galleryImages,
        ];

        return new ConfigElementResult(ConfigElementResult::TYPE_FORMATTED_VALUE, $tinySliderGallery);
    }
}
