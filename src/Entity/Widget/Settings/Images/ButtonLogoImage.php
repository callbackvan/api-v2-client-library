<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class ButtonLogoImage extends AbstractImage
{
    const BASE_URL = self::BASE_IMAGES_URL.'brand_logo/';

    /**
     * ButtonLogoImage constructor.
     */
    public function __construct()
    {
        parent::__construct(
            self::BASE_URL
        );
    }
}
