<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    /** @var Position */
    private $position;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position::setX()
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position::getX()
     */
    public function testX()
    {
        $this->assertSame(0, $this->position->getX());
        $this->position->setX((string)$this->example['x']);
        $this->assertSame($this->example['x'], $this->position->getX());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position::setY()
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position::getY()
     */
    public function testY()
    {
        $this->assertSame(0, $this->position->getY());
        $this->position->setY((string)$this->example['y']);
        $this->assertSame($this->example['y'], $this->position->getY());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position::toAPI()
     */
    public function testToAPIAll()
    {
        $this->position->setX($this->example['x']);
        $this->position->setY($this->example['y']);

        $this->assertSame($this->example, $this->position->toAPI());
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
