<?php

namespace CallbackHunterAPIv2\Entity\Collection;

use CallbackHunterAPIv2\Entity\Widget\Phone\PhoneInterface;

/**
 * Class PhonesCollection
 *
 * @package CallbackHunterAPIv2\Entity\Collection
 */
class PhonesCollection extends \SplObjectStorage
{
    /**
     * @param object $object
     * @param null   $data
     */
    public function attach($object, $data = null)
    {
        if ($object instanceof PhoneInterface) {
            parent::attach($object, $data);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        /** @var PhoneInterface $phone */
        foreach ($this as $phone) {
            $data[] = [
                'id' => $phone->getId(),
                'phone' => $phone->getPhone(),
            ];
        }

        return $data;
    }
}
