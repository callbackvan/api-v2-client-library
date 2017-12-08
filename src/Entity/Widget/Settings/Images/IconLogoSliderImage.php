<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class IconLogoSliderImage extends AbstractImage
{
    /**
     * IconLogoSliderImage constructor.
     */
    public function __construct()
    {
        $this->baseUrl
            = 'https://cdn.callbackhunter.com/uploads/brand_large_logo/';
    }
}
