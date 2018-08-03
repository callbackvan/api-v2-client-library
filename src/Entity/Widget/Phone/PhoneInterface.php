<?php

namespace CallbackHunterAPIv2\Entity\Widget\Phone;

/**
 * Class Phone
 *
 * @package CallbackHunterAPIv2\Entity\Widget\Phone
 */
interface PhoneInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     */
    public function setPhone($phone);
}
