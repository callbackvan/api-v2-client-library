<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;

interface SettingsInterface extends BaseEntityInterface
{
    const BACKGROUND_TYPE_COLOR = 'color';
    const BACKGROUND_TYPE_PRESET = 'preset';
    const BACKGROUND_TYPE_FILE = 'file';
    const BACKGROUND_TYPES
        = [
            self::BACKGROUND_TYPE_COLOR,
            self::BACKGROUND_TYPE_PRESET,
            self::BACKGROUND_TYPE_FILE,
        ];

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

    /**
     * @return string|null
     */
    public function getBackgroundTypeForSlider();
}
