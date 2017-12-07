<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\SettingsInterface;

interface SettingsFactoryInterface
{
    /**
     * @param array $data
     * @return SettingsInterface
     */
    public function fromAPI(array $data);
}
