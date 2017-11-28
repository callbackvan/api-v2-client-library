<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\ImagesInterface;

interface ImagesFactoryInterface
{
    /**
     * @param array $data
     * @return ImagesInterface
     */
    public function fromAPI(array $data);
}
