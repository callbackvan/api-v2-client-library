<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

/**
 * Class Position
 *
 * Позиционирование элемента
 */
class Position implements BaseEntityInterface
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setX($x)
    {
        $this->x = (int)$x;

        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $y
     *
     * @return $this
     */
    public function setY($y)
    {
        $this->y = (int)$y;

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'x' => $this->getX(),
            'y' => $this->getY(),
        ];
    }
}
