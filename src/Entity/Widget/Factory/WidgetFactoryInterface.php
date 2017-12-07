<?php

namespace CallbackHunterAPIv2\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;

interface WidgetFactoryInterface
{
    /**
     * @param array $data
     * @return WidgetInterface
     */
    public function fromAPI(array $data);
}
