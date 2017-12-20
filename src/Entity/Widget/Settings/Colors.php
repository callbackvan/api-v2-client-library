<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

/**
 * Class Colors
 *
 * Цвета для элементов виджета
 */
class Colors implements BaseEntityInterface
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
     * @var string
     */
    private $sliderTextColor;

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

    /**
     * @return string
     */
    public function getSliderTextColor()
    {
        return $this->sliderTextColor;
    }

    /**
     * @param string $sliderTextColor
     *
     * @return $this
     */
    public function setSliderTextColor($sliderTextColor)
    {
        $this->sliderTextColor = $sliderTextColor;

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'iconBackground' => $this->getIconBackground(),
            'backgroundSlider' => $this->getBackgroundSlider(),
            'sliderTextColor' => $this->getSliderTextColor(),
        ];
    }
}
