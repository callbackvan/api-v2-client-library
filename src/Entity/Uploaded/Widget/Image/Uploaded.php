<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

class Uploaded implements UploadedInterface
{
    /** @var string */
    private $url;
    /** @var PositionInterface */
    private $position;
    /** @var SizesInterface */
    private $sizes;

    /**
     * Uploaded constructor.
     *
     * @param string            $url
     * @param PositionInterface $position
     * @param SizesInterface    $sizes
     */
    public function __construct($url, $position, $sizes)
    {
        $this->url = $url;
        $this->position = $position;
        $this->sizes = $sizes;
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

    /**
     * @return SizesInterface
     */
    public function getSizes()
    {
        return $this->sizes;
    }
}
