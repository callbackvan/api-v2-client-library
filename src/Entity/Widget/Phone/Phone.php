<?php

namespace CallbackHunterAPIv2\Entity\Widget\Phone;

/**
 * Class Phone
 *
 * @package CallbackHunterAPIv2\Entity\Widget\Phone
 */
class Phone implements PhoneInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $phone;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}
