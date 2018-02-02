<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\SizesInterface;

interface SizesFactoryInterface
{
    /**
     * @param array $data
     *
     * @return SizesInterface
     */
    public function fromAPI(array $data);
}
