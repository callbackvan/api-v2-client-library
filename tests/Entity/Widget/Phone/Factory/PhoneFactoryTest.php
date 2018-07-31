<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Phone\Factory;

use CallbackHunterAPIv2\Entity\Widget\Phone\Factory\PhoneFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class PhoneFactoryTest
 *
 * @package CallbackHunterAPIv2\Tests\Entity\Widget\Phone\Factory
 */
class PhoneFactoryTest extends TestCase
{
    /**
     * @var PhoneFactory
     */
    private $factory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Phone\Factory\PhoneFactory::fromAPI
     */
    public function testFromAPI()
    {
        $example = [
            'uid' => 123,
            'phone' => '911',
        ];

        $phone = $this->factory->fromAPI($example);

        $this->assertSame($example['uid'], $phone->getId());
        $this->assertSame($example['phone'], $phone->getPhone());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new PhoneFactory;
    }
}
