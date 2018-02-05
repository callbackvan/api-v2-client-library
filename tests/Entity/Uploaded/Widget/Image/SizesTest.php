<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes;
use PHPUnit\Framework\TestCase;

class SizesTest extends TestCase
{
    /** @var Sizes */
    private $position;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes::setWidth()
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes::getWidth()
     */
    public function testWidth()
    {
        $this->assertSame(0, $this->position->getWidth());
        $this->position->setWidth((string)$this->example['width']);
        $this->assertSame($this->example['width'], $this->position->getWidth());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes::setHeight()
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes::getHeight()
     */
    public function testHeight()
    {
        $this->assertSame(0, $this->position->getHeight());
        $this->position->setHeight((string)$this->example['height']);
        $this->assertSame(
            $this->example['height'],
            $this->position->getHeight()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Sizes::toAPI()
     */
    public function testToAPIAll()
    {
        $this->position->setWidth($this->example['width']);
        $this->position->setHeight($this->example['height']);

        $this->assertSame($this->example, $this->position->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->position = new Sizes();
        $this->example = [
            'width' => 77,
            'height' => 88,
        ];
    }
}
