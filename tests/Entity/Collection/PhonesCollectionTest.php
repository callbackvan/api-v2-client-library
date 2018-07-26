<?php

namespace CallbackHunterAPIv2\Tests\Entity\Collection;

use CallbackHunterAPIv2\Entity\Collection\PhonesCollection;
use CallbackHunterAPIv2\Entity\Widget\Phone\PhoneInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class PhonesCollectionTest
 *
 * @package CallbackHunterAPIv2\Tests\Entity\Collection
 */
class PhonesCollectionTest extends TestCase
{
    /**
     * @var PhonesCollection
     */
    private $collection;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Collection\PhonesCollection::attach
     */
    public function testAttach()
    {
        $phone = $this->createMock(PhoneInterface::class);

        $this->collection->attach($phone);

        $this->assertTrue($this->collection->contains($phone));
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Collection\PhonesCollection::toArray
     */
    public function testToArray()
    {
        $data = [
            0 => [
                'id' => 123,
                'phone' => '911',
            ],
            1 => [
                'id' => 1234,
                'phone' => '9111',
            ],
        ];

        $this->collection->attach(
            $phone1 = $this->createMock(PhoneInterface::class)
        );

        $this->collection->attach(
            $phone2 = $this->createMock(PhoneInterface::class)
        );

        $phone1
            ->expects($this->once())
            ->method('getId')
            ->willReturn($data[0]['id']);

        $phone1
            ->expects($this->once())
            ->method('getPhone')
            ->willReturn($data[0]['phone']);

        $phone2
            ->expects($this->once())
            ->method('getId')
            ->willReturn($data[1]['id']);

        $phone2
            ->expects($this->once())
            ->method('getPhone')
            ->willReturn($data[1]['phone']);

        $this->assertSame($data, $this->collection->toArray());
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->collection = new PhonesCollection;
    }
}
