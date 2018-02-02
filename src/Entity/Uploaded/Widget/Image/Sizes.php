<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

class Sizes implements SizesInterface
{
    /**
     * @var integer
     */
    private $width = 0;

    /**
     * @var integer
     */
    private $height = 0;

    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param integer $width
     *
     * @return static
     */
    public function setWidth($width)
    {
        $this->width = (int)$width;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param integer $height
     *
     * @return static
     */
    public function setHeight($height)
    {
        $this->height = (int)$height;

        return $this;
    }

    public function toAPI()
    {
        return [
            'width'  => $this->getWidth(),
            'height' => $this->getHeight(),
        ];
    }
}
