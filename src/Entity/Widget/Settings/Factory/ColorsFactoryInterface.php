<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\ColorsInterface;

interface ColorsFactoryInterface
{
    /**
     * @param array $data
     *
     * @return ColorsInterface
     */
    public function fromAPI(array $data);
}
