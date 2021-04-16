<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\EventListener;

use Contao\Controller;
use HeimrichHannot\TinySliderBundle\ConfigElementType\TinySliderConfigElementType;

class LoadLanguageFileListener
{
    public function __invoke(string $name, string $currentLanguage, string $cacheKey): void
    {
        if ('tl_list_config_element' === $name) {
            Controller::loadLanguageFile('tl_reader_config_element');
            $GLOBALS['TL_LANG']['tl_list_config_element']['reference'][TinySliderConfigElementType::getType()] =
                $GLOBALS['TL_LANG']['tl_reader_config_element']['reference'][TinySliderConfigElementType::getType()];

            return;
        }
    }
}
