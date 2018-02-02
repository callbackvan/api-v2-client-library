<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

class Uploaded implements UploadedInterface
{
    /** @var string */
    private $url;
    /** @var PositionInterface */
    private $position;

    /**
     * Uploaded constructor.
     *
     * @param string            $url
     * @param PositionInterface $position
     */
    public function __construct($url, $position)
    {
        $this->url = $url;
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return PositionInterface
     */
    public function getPosition()
    {
        return $this->position;
    }
}
