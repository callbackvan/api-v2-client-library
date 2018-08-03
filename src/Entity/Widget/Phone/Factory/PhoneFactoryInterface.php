<?php

namespace CallbackHunterAPIv2\Entity\Widget\Phone\Factory;

use CallbackHunterAPIv2\Entity\Widget\Phone\Phone;

/**
 * Class PhoneFactory
 *
 * @package CallbackHunterAPIv2\Entity\Widget\Factory
 */
interface PhoneFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Phone
     */
    public function fromAPI(array $data);
}
