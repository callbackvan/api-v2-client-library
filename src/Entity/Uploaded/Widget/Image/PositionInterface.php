<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

/**
 * Interface PositionInterface
 * Описание позиции верхнего левого угла квадрата для рамки обрезки
 *
 * @package CallbackHunterAPIv2\Entity\Uploaded\Widget\Image
 */
interface PositionInterface
{
    /**
     * @return integer
     */
    public function getX();

    /**
     * @return integer
     */
    public function getY();

    /**
     * @return array
     */
    public function toAPI();
}
