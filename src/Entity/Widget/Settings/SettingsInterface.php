<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

interface SettingsInterface extends BaseEntityInterface
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

    /**
     * @return ChannelInterface
     */
    public function getChannels();
}
