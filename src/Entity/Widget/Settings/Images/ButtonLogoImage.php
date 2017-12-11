<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class ButtonLogoImage extends AbstractImage
{
    /**
     * ButtonLogoImage constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'https://cdn.callbackhunter.com/uploads/brand_logo/'
        );
    }
}
