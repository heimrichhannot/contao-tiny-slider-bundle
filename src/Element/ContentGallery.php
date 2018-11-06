<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Element;

use Contao\System;
use HeimrichHannot\SlickBundle\Frontend\Slick;
use HeimrichHannot\TinySliderBundle\Frontend\Gallery;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;

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
        if (System::getContainer()->get('huh.utils.container')->isBackend()) {
            return parent::generate();
        }

        parent::generate();

        if ($this->tinySliderConfig < 1) {
            return '';
        }

        $configModelAdapter = System::getContainer()->get('contao.framework')->getAdapter(TinySliderConfigModel::class);

        if (null === ($config = $configModelAdapter->findByPk($this->tinySliderConfig))) {
            return '';
        }

        // Map content fields to slick fields
        $this->arrData['tinySliderMultiSRC']      = $this->arrData['multiSRC'];
        $this->arrData['tinySliderOrderSRC']      = $this->arrData['orderSRC'];
        $this->arrData['tinySliderSortBy']        = $this->arrData['sortBy'];
        $this->arrData['tinySliderUseHomeDir']    = $this->arrData['useHomeDir'];
        $this->arrData['tinySliderSize']          = $this->arrData['size'];
        $this->arrData['tinySliderFullsize']      = $this->arrData['fullsize'];
        $this->arrData['tinySliderNumberOfItems'] = $this->arrData['numberOfItems'];
        $this->arrData['tinySliderCustomTpl']     = $this->arrData['customTpl'];

        $gallery = new Gallery(System::getContainer()->get('huh.tiny_slider.util.config')->createSettings($this->arrData, $config));

        $this->Template->class      .= ' '.System::getContainer()->get('huh.tiny_slider.util.config')->getCssClassFromModel($config);
        $this->Template->attributes .= System::getContainer()->get('huh.tiny_slider.util.config')->getAttributesFromModel($config);
        $this->Template->images     = $gallery->getImages();

        return $this->Template->parse();
    }
}