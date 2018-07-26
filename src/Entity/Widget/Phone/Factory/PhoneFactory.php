<?php

namespace CallbackHunterAPIv2\Entity\Widget\Phone\Factory;

use CallbackHunterAPIv2\Entity\Widget\Factory\BaseFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Phone\Phone;

/**
 * Class PhoneFactory
 *
 * @package CallbackHunterAPIv2\Entity\Widget\Factory
 */
class PhoneFactory implements BaseFactoryInterface, PhoneFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Phone
     */
    public function fromAPI(array $data)
    {
        $phone = new Phone;

        if (isset($data['id'])) {
            $phone->setId($data['id']);
        }

        if (isset($data['phone'])) {
            $phone->setPhone($data['phone']);
        }

        return $phone;
    }
}
