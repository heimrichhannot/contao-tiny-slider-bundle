<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Element;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;

class ContentStart extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_tiny_slider_content_start';

    public function generate()
    {
        if (System::getContainer()->get('huh.utils.container')->isBackend()) {
            $this->strTemplate     = 'be_wildcard';
            $this->Template        = new BackendTemplate($this->strTemplate);
            $this->Template->title = $this->headline;
        }

        parent::generate();

        if (!$this->tinySliderConfig) {
            return '';
        }

        $framework = System::getContainer()->get('contao.framework');

        /** @var TinySliderConfigModel $tinyConfigModel */
        $tinyConfigModel = $framework->getAdapter(TinySliderConfigModel::class);

        if (null === ($config = $tinyConfigModel->findByPk($this->tinySliderConfig))) {
            return '';
        }

        $this->Template->class      .= ' '.System::getContainer()->get('huh.tiny_slider.util.config')->getCssClassFromModel($config);
        $this->Template->attributes .= System::getContainer()->get('huh.tiny_slider.util.config')->getAttributesFromModel($config);

        return $this->Template->parse();
    }

    /**
     * Generate the content element.
     */
    protected function compile()
    {
    }
}
