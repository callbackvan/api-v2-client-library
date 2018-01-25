<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\PositionInterface;

interface PositionFactoryInterface
{
    /**
     * @param array $data
     *
     * @return PositionInterface
     */
    public function fromAPI(array $data);
}
