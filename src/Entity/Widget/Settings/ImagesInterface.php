<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage;

interface ImagesInterface
{
    /**
     * @return AbstractImage
     */
    public function getLogo();

    /**
     * @param AbstractImage $logo
     */
    public function setLogo($logo);
}
