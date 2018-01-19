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
    private $sliderText;

    /**
     * @var string
     */
    private $sliderIcons;

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
        $this->iconBackground = (string)$color;

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
        $this->backgroundSlider = (string)$color;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSliderText()
    {
        return $this->sliderText;
    }

    /**
     * @param string $sliderText
     *
     * @return $this
     */
    public function setSliderText($sliderText)
    {
        $this->sliderText = (string)$sliderText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSliderIcons()
    {
        return $this->sliderIcons;
    }

    /**
     * @param string $sliderIcons
     *
     * @return $this
     */
    public function setSliderIcons($sliderIcons)
    {
        $this->sliderIcons = (string)$sliderIcons;

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'iconBackground'   => $this->getIconBackground(),
            'backgroundSlider' => $this->getBackgroundSlider(),
            'sliderText'       => $this->getSliderText(),
            'sliderIcons'      => $this->getSliderIcons(),
        ];
    }
}
