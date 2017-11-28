<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\PositionInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\ColorsInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\ImagesInterface;

interface SettingsInterface
{
    /**
     * @return PositionInterface
     */
    public function getPosition();

    /**
     * @return ColorsInterface
     */
    public function getColors();

    /**
     * @return ImagesInterface
     */
    public function getImages();
}
