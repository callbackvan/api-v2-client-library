<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

/**
 * Class Colors
 *
 * Цвета для элементов виджета
 */
class Colors implements ColorsInterface
{
    /**
     * @var string
     */
    private $iconBackground;

    /**
     * @var string
     */
    private $backgroundSlider;

    /**
     * @return string
     */
    public function getIconBackground()
    {
        return $this->iconBackground;
    }

    /**
     * @param $color
     *
     * @return $this
     */
    public function setIconBackground($color)
    {
        $this->iconBackground = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundSlider()
    {
        return $this->backgroundSlider;
    }

    /**
     * @param $color
     *
     * @return $this
     */
    public function setBackgroundSlider($color)
    {
        $this->backgroundSlider = $color;

        return $this;
    }

}