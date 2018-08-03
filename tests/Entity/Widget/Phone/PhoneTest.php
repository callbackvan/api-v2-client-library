<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Phone;

use CallbackHunterAPIv2\Entity\Widget\Phone\Phone;
use PHPUnit\Framework\TestCase;

/**
 * Class PhoneTest
 *
 * @package CallbackHunterAPIv2\Tests\Entity\Widget\Phone
 */
class PhoneTest extends TestCase
{
    /**
     * @var Phone
     */
    private $entity;

    /**
     * @var array
     */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Phone\Phone::getId
     * @covers \CallbackHunterAPIv2\Entity\Widget\Phone\Phone::setId
     */
    public function testId()
    {
        $this->entity->setId($this->example['id']);
        $this->assertSame($this->example['id'], $this->entity->getId());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Phone\Phone::getPhone
     * @covers \CallbackHunterAPIv2\Entity\Widget\Phone\Phone::setPhone
     */
    public function testPhone()
    {
        $this->entity->setPhone($this->example['phone']);
        $this->assertSame($this->example['phone'], $this->entity->getPhone());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->example = [
            'id' => 123,
            'phone' => '911',
        ];

        $this->entity = new Phone;
    }
}
