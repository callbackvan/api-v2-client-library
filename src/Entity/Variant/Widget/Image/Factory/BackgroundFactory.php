<?php

namespace CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Background;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\BackgroundInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;

class BackgroundFactory implements BackgroundFactoryInterface
{
    /**
     * @param array $data
     *
     * @return BackgroundInterface
     */
    public function fromAPI(array $data)
    {
        $background = new Background;
        foreach ($data as $k => $variants) {
            $setterMethod = 'set'.ucfirst($k);
            if (!method_exists($background, $setterMethod)) {
                continue;
            }

            $images = [];
            foreach ((array)$variants as $variant) {
                if (isset($variant['value']) && $value = $variant['value']) {
                    $image = new BackgroundSliderImage;
                    $image->setName($value);
                    $image->setBaseUrl(BackgroundSliderImage::PRESET_URL);
                    $images[] = $image;
                }
            }

            $background->{$setterMethod}($images);
        }

        return $background;
    }
}
