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
     * @return string|null
     */
    public function getIconBackground()
    {
        return $this->iconBackground;
    }

    /**
     * @param string $color
     *
     * @return $this
     */
    public function setIconBackground($color)
    {
        $this->iconBackground = (string) $color;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBackgroundSlider()
    {
        return $this->backgroundSlider;
    }

    /**
     * @param string $color
     *
     * @return $this
     */
    public function setBackgroundSlider($color)
    {
        $this->backgroundSlider = (string) $color;

        return $this;
    }

    /**
     * @return string|null
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
        $this->sliderTextColor = (string) $sliderTextColor;

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
