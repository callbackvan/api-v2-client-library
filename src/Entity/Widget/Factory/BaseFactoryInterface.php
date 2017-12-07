<?php

namespace CallbackHunterAPIv2\Entity\Widget\Factory;

interface BaseFactoryInterface
{
    /**
     * @param array $data
     */
    public function fromAPI(array $data);
}
