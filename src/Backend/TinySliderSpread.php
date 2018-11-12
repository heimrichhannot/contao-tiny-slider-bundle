<?php
/**
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\TinySliderBundle\Backend;


use Contao\Backend;
use Contao\CoreBundle\Framework\FrameworkAwareInterface;
use Contao\CoreBundle\Framework\FrameworkAwareTrait;
use Contao\DataContainer;
use Contao\Image;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;

class TinySliderSpread implements FrameworkAwareInterface
{
    use FrameworkAwareTrait;

    /**
     * Return all gallery templates as array
     *
     * @return array
     */
    public function getGalleryTemplates()
    {
        return Backend::getTemplateGroup('tiny_slider_gallery_');
    }

    public function setFileTreeFlags($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord) {
            if ($dc->activeRecord->type == 'tiny-slider-gallery') {
                $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['isGallery'] = true;
            }
        }

        return $varValue;
    }

    public function editTinySliderConfig(DataContainer $dc)
    {
        return ($dc->value < 1)
            ? ''
            : ' <a href="contao/main.php?do=tiny_slider_config&amp;act=edit&amp;id='.$dc->value.'&amp;popup=1&amp;nb=1&amp;rt='.REQUEST_TOKEN.'" title="'.sprintf(specialchars($GLOBALS['TL_LANG']['tl_tiny_slider_spread']['editSlickConfig'][1]), $dc->value).'" style="padding-left:3px" onclick="Backend.openModalIframe({\'width\':768,\'title\':\''.specialchars(
                str_replace(
                    "'",
                    "\\'",
                    sprintf($GLOBALS['TL_LANG']['tl_tiny_slider_spread']['editTinySliderConfig'][1], $dc->value)
                )
            ).'\',\'url\':this.href});return false">'.Image::getHtml('alias.gif', $GLOBALS['TL_LANG']['tl_tiny_slider_spread']['editTinySliderConfig'][0], 'style="vertical-align:top"').'</a>';
    }

    public function getResponsiveConfigurations($dc)
    {
        $options = [];

        /** @var TinySliderConfigModel $configAdapter */
        $configAdapter = $this->framework->getAdapter(TinySliderConfigModel::class);

        if (null === ($configs = $configAdapter->findBy(['type = ?'], 'responsive'))) {
            return $options;
        }

        return $configs->fetchEach('title');
    }
}