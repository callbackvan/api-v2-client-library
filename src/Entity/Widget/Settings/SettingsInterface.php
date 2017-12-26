<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;

interface SettingsInterface extends BaseEntityInterface
{
    /**
     * @return Position
     */
    public function getPosition();

    /**
     * @return Colors
     */
    public function getColors();

    /**
     * @return Images\Images
     */
    public function getImages();

    /**
     * @return Channels
     */
    public function getChannels();

    /**
     * @return Sizes
     */
    public function getSizes();
}
