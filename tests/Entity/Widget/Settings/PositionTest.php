<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    /** @var Position */
    private $position;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::setX()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::getX()
     */
    public function testX()
    {
        $this->position->setX($this->example['x']);
        $this->assertSame((int)$this->example['x'], $this->position->getX());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::setY()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::getY()
     */
    public function testY()
    {
        $this->position->setY($this->example['y']);
        $this->assertSame((int)$this->example['y'], $this->position->getY());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::toAPI()
     */
    public function testToAPIAll()
    {
        $this->position->setX($this->example['x']);
        $this->position->setY($this->example['y']);
        $this->position->setFixed($this->example['fixed']);

        $this->assertSame($this->example, $this->position->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::toAPI()
     */
    public function testToAPIPartial()
    {
        $this->position->setY($this->example['y']);
        $this->position->setFixed($this->example['fixed']);

        $expected = $this->example;
        $expected['x'] = $this->position->getX();

        $this->assertSame($expected, $this->position->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::isFixed()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::setFixed()
     */
    public function testIsFixed()
    {
        $excepted = false;
        $this->assertNull($this->position->isFixed());
        $this->position->setFixed($excepted);
        $this->assertEquals($excepted, $this->position->isFixed());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->position = new Position();
        $this->example = [
            'x'     => 77,
            'y'     => 88,
            'fixed' => false,
        ];
    }
}
