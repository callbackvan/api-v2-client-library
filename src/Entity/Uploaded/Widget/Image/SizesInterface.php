<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

/**
 * Interface SizesInterface
 * Описание размеров квадрата для рамки обрезки
 *
 * @package CallbackHunterAPIv2\Entity\Uploaded\Widget\Image
 */
interface SizesInterface
{
    /**
     * @return integer
     */
    public function getHeight();

    /**
     * @return integer
     */
    public function getWidth();

    /**
     * @return array
     */
    public function toAPI();
}
