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

class ContentSeparator extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_tiny_slider_content_separator';

    /**
     * Generate the content element.
     */
    protected function compile()
    {
        if (System::getContainer()->get('huh.utils.container')->isBackend()) {
            $this->strTemplate = 'be_wildcard';
            $this->Template = new BackendTemplate($this->strTemplate);
        }
    }
}
