<?php

namespace CallbackHunterAPIv2\Entity\Variant\Widget\Image;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;

interface BackgroundInterface
{
    /**
     * Получить варианты фонов для слайдера
     *
     * @return BackgroundSliderImage[]
     */
    public function getBackgroundSlider();
}
