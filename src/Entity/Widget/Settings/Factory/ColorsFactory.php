<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Factory\BaseFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings;

class ColorsFactory implements BaseFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Settings\Colors
     */
    public function fromAPI(array $data)
    {
        $colors = new Settings\Colors();

        if (isset($data['iconBackground'])) {
            $colors->setIconBackground($data['iconBackground']);
        }

        if (isset($data['backgroundSlider'])) {
            $colors->setBackgroundSlider($data['backgroundSlider']);
        }

        return $colors;
    }
}
