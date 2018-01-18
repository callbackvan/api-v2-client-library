<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class BackgroundSliderImage extends AbstractImage
{
    const BASE_URL = self::BASE_IMAGES_URL.'slide_image/';
    const PRESET_URL = self::BASE_URL.'preset/';

    /**
     * BackgroundSliderImage constructor.
     */
    public function __construct()
    {
        parent::__construct(
            self::BASE_URL
        );
    }
}
