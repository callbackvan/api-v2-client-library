<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes;

class SizesFactory implements SizesFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Sizes
     */
    public function fromAPI(array $data)
    {
        $position = new Sizes;

        if (isset($data['width'])) {
            $position->setWidth($data['width']);
        }

        if (isset($data['height'])) {
            $position->setHeight($data['height']);
        }

        return $position;
    }
}
