<?php
/**
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\TinySliderBundle\Backend;


use Contao\ArticleModel;
use Contao\Backend;
use Contao\ContentModel;
use Contao\CoreBundle\Framework\FrameworkAwareInterface;
use Contao\CoreBundle\Framework\FrameworkAwareTrait;
use Contao\DataContainer;

class Content extends Backend implements FrameworkAwareInterface
{
    use FrameworkAwareTrait;

    /**
     * Get content slider carousel options
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function getContentSliderCarousels(DataContainer $dc): array
    {
        $options = [];

        /** @var ContentModel $contentModelAdapter */
        $contentModelAdapter = $this->framework->getAdapter(ContentModel::class);

        if (null === ($sliders = $contentModelAdapter->findBy('type', 'tiny-slider-content-start'))) {
            return $options;
        }

        /** @var ArticleModel $articleModelAdapter */
        $articleModelAdapter = $this->framework->getAdapter(ArticleModel::class);

        while ($sliders->next()) {

            $objArticle = \ArticleModel::findByPk($sliders->pid);

            if (null === ($article = $articleModelAdapter->findByPk($sliders->pid))) {
                continue;
            }

            $options[$sliders->id] = sprintf($GLOBALS['TL_LANG']['tl_content']['contentSliderCarouselSelectOption'], $objArticle->title, $objArticle->id, $sliders->id);

        }


        return $options;
    }

}