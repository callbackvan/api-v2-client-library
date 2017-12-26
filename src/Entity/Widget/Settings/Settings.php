<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;

class Settings implements SettingsInterface
{
    /** @var Colors */
    private $colors;

    /** @var Position */
    private $position;

    /** @var Images */
    private $images;

    /** @var Channels */
    private $channels;

    /** @var Sizes */
    private $sizes;

    /**
     * @param Colors   $colors
     * @param Position $position
     * @param Images   $images
     * @param Channels $channels
     * @param Sizes    $sizes
     */
    public function __construct(
        Colors $colors,
        Position $position,
        Images $images,
        Channels $channels,
        Sizes $sizes
    ) {
        $this->colors = $colors;
        $this->position = $position;
        $this->images = $images;
        $this->channels = $channels;
        $this->sizes = $sizes;
    }

    /**
     * @return Colors
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return Images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return Channels
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @return Sizes
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'colors'   => $this->colors->toAPI(),
            'position' => $this->position->toAPI(),
            'images'   => $this->images->toAPI(),
            'channels' => $this->channels->toAPI(),
            'sizes'    => $this->sizes->toAPI(),
        ];
    }
}
