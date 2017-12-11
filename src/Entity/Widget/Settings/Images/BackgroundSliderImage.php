<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class BackgroundSliderImage extends AbstractImage
{
    /**
     * BackgroundSliderImage constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'https://cdn.callbackhunter.com/uploads/slide_image/'
        );
    }
}
