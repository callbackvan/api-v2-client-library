<?php

namespace Tests\Entity\Widget\Settings;

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
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::toApi()
     */
    public function testToApiAll()
    {
        $this->position->setX($this->example['x']);
        $this->position->setY($this->example['y']);

        $this->assertSame($this->example, $this->position->toApi());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Position::toApi()
     */
    public function testToApiPartial()
    {
        $this->position->setY($this->example['y']);

        $expected = $this->example;
        $expected['x'] = $this->position->getX();

        $this->assertSame($expected, $this->position->toApi());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->position = new Position();
        $this->example = [
            'x' => 77,
            'y' => 88,
        ];
    }

}
