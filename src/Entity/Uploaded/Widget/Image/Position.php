<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

class Position implements PositionInterface
{
    /**
     * @var integer
     */
    private $x = 0;

    /**
     * @var integer
     */
    private $y = 0;

    /**
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param integer $x
     *
     * @return static
     */
    public function setX($x)
    {
        $this->x = (int)$x;

        return $this;
    }

    /**
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param integer $y
     *
     * @return static
     */
    public function setY($y)
    {
        $this->y = (int)$y;

        return $this;
    }

    public function toAPI()
    {
        return [
            'x' => $this->getX(),
            'y' => $this->getY(),
        ];
    }
}
