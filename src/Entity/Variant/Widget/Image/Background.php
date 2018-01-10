<?php

namespace CallbackHunterAPIv2\Entity\Variant\Widget\Image;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;

/**
 * Варианты фонов виджета
 *
 * @package CallbackHunterAPIv2\Entity\Variant\Widget\Image
 */
class Background implements BackgroundInterface
{
    /**
     * Варианты слайдера
     *
     * @var BackgroundSliderImage[]
     */
    private $backgroundSlider = [];

    /**
     * Получить варианты фонов для слайдера
     *
     * @return BackgroundSliderImage[]
     */
    public function getBackgroundSlider()
    {
        return $this->backgroundSlider;
    }

    /**
     * Установить варианты слайдера
     *
     * @param BackgroundSliderImage $backgroundSlider
     */
    public function setBackgroundSlider($backgroundSlider)
    {
        $this->backgroundSlider = $backgroundSlider;
    }
}
