<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Texts;

class TextsFactory
{
    /**
     * @param array $data
     *
     * @return Texts
     */
    public function fromAPI(array $data)
    {
        $texts = new Texts();

        if (isset($data['sliderCallbackButton'])) {
            $texts->setSliderCallbackButton($data['sliderCallbackButton']);
        }

        if (isset($data['sliderTitle'])) {
            $texts->setSliderTitle($data['sliderTitle']);
        }

        return $texts;
    }
}
