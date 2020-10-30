<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
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