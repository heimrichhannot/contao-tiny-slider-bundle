<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFramework;
use HeimrichHannot\ListBundle\Event\ListBeforeRenderEvent;
use HeimrichHannot\TinySliderBundle\Asset\FrontendAssets;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;
use HeimrichHannot\TinySliderBundle\Util\Config;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

class ListBeforeRenderListener
{
    /**
     * @var ContaoFramework
     */
    private $contaoFramework;
    /**
     * @var Config
     */
    private $configUtil;
    /**
     * @var FrontendAssets
     */
    private $frontendAssets;

    public function __construct(ContaoFramework $contaoFramework, Config $configUtil, FrontendAssets $frontendAssets)
    {
        $this->contaoFramework = $contaoFramework;
        $this->configUtil = $configUtil;
        $this->frontendAssets = $frontendAssets;
    }

    /**
     * @ServiceTag("kernel.event_listener", event="huh.list.event.list_before_render")
     */
    public function onListBeforeRender(ListBeforeRenderEvent $event): void
    {
        $templateData = $event->getTemplateData();
        $listConfig = $event->getListConfig();

        /** @var TinySliderConfigModel $tinyConfigModel */
        $tinyConfigModel = $this->contaoFramework->getAdapter(TinySliderConfigModel::class);

        if ($listConfig->addTinySlider && null !== ($config = $tinyConfigModel->findByPk($listConfig->tinySliderConfig))) {
            $dataAttributes = $templateData['dataAttributes'] ?: '';
            $dataAttributes .= $this->configUtil->getAttributes($config);
            $templateData['wrapperClass'] = $this->configUtil->getCssClass($config);
            $templateData['dataAttributes'] = $dataAttributes;
            $templateData['itemsClass'] = 'tiny-slider-container';

            $this->frontendAssets->addFrontendAssets();

            $event->setTemplateData($templateData);
        }
    }
}
