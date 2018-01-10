<?php

namespace CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Variant\Widget\Image\BackgroundInterface;

interface BackgroundFactoryInterface
{
    /**
     * @param array $data
     *
     * @return BackgroundInterface
     */
    public function fromAPI(array $data);
}
