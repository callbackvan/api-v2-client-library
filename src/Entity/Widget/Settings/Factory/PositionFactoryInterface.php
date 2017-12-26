<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\PositionInterface;

interface PositionFactoryInterface
{
    /**
     * @param array $data
     *
     * @return PositionInterface
     */
    public function fromAPI(array $data);
}
