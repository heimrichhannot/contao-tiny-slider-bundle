<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Element;

use Contao\System;
use HeimrichHannot\TinySliderBundle\Asset\FrontendAssets;
use HeimrichHannot\TinySliderBundle\Frontend\Gallery;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;
use HeimrichHannot\TinySliderBundle\Util\Config;
use HeimrichHannot\UtilsBundle\Util\Utils;

class ContentGallery extends \Contao\ContentGallery
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_tiny_slider';

    /**
     * Return if there are no files.
     *
     * @return string
     */
    public function generate()
    {
        // show gallery instead of tidy slider in backend mode
        if (System::getContainer()->get(Utils::class)->container()->isBackend()) {
            return parent::generate();
        }

        $result = parent::generate();

        if (empty($result)) {
            return '';
        }

        if ($this->tinySliderConfig < 1) {
            return '';
        }

        $tinyConfigModel = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);

        if (null === ($config = $tinyConfigModel->findByPk($this->tinySliderConfig))) {
            return '';
        }

        System::getContainer()->get(FrontendAssets::class)->addFrontendAssets();

        // Map content fields to tiny slider fields
        $this->arrData['tinySliderMultiSRC'] = $this->arrData['multiSRC'];
        $this->arrData['tinySliderOrderSRC'] = $this->arrData['orderSRC'];
        $this->arrData['tinySliderSortBy'] = $this->arrData['sortBy'];
        $this->arrData['tinySliderUseHomeDir'] = $this->arrData['useHomeDir'];
        $this->arrData['tinySliderSize'] = $this->arrData['size'];
        $this->arrData['tinySliderFullsize'] = $this->arrData['fullsize'];
        $this->arrData['tinySliderNumberOfItems'] = $this->arrData['numberOfItems'];
        $this->arrData['tinySliderCustomTpl'] = $this->arrData['customTpl'];

        $gallery = new Gallery(System::getContainer()->get(Config::class)->createSettings($this->arrData, $config));

        $this->Template->class .= ' '.System::getContainer()->get(Config::class)->getCssClass($config);
        $this->Template->attributes .= System::getContainer()->get(Config::class)->getAttributes($config);
        $this->Template->images = $gallery->getImages();

        return $this->Template->parse();
    }
}
