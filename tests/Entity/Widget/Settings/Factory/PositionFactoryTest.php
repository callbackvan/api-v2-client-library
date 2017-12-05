<?php

namespace Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\PositionFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Position;
use PHPUnit\Framework\TestCase;

class PositionFactoryTest extends TestCase
{
    /** @var PositionFactory */
    private $positionFactory;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\PositionFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $response = $this->positionFactory->fromAPI($this->example);
        $this->assertInstanceOf(Position::class, $response);

        $expected = new Position();
        $expected->setX((int)$this->example['x'])->setY((int)$this->example['y']);

        $this->assertEquals($expected, $response);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->positionFactory = new PositionFactory();
        $this->example = [
            'x' => 77,
            'y' => 88,
        ];
    }

}
