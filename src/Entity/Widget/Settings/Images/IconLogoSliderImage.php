<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class IconLogoSliderImage extends AbstractImage
{
    const BASE_URL = self::BASE_IMAGES_URL.'brand_large_logo/';

    /**
     * IconLogoSliderImage constructor.
     */
    public function __construct()
    {
        parent::__construct(
            self::BASE_URL
        );
    }
}
