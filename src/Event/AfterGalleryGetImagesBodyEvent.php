<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TinySliderBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class AfterGalleryGetImagesBodyEvent extends Event
{
    const NAME = 'huh.tiny_slider.after_gallery_get_images_body_event';

    /**
     * @var array
     */
    protected $body;
    /**
     * @var array
     */
    protected $images;

    public function __construct(array $body, array $images)
    {
        $this->body = $body;
        $this->images = $images;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    public function getImages(): array
    {
        return  $this->images;
    }
}
