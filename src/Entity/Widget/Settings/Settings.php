<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

class Settings
{
    private $colors;

    /**
     * @var Position
     */
    private $position;

    /** @var Images\Images */
    private $images;

    /** @var Channels\Channels */
    private $channels;

    /**
     * @param Colors $colors
     * @param Position $position
     * @param Images\Images $images
     * @param Channels\Channels $channels
     */
    public function __construct(
        Colors $colors,
        Position $position,
        Images\Images $images,
        Channels\Channels $channels
    ) {
        $this->colors = $colors;
        $this->position = $position;
        $this->images = $images;
        $this->channels = $channels;
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
     * @return Images\Images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return Channels\Channels
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @return array
     */
    public function toApi()
    {
        return [
            'colors' => $this->colors->toApi(),
            'position' => $this->position->toApi(),
            'images' => $this->images->toApi(),
            'channels' => $this->channels->toApi(),
        ];
    }

}