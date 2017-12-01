<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

/**
 * Class Position
 *
 * Позиционирование элемента
 */
class Position implements PositionInterface
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
}