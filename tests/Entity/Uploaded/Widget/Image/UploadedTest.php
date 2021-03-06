<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\PositionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\SizesInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded;
use PHPUnit\Framework\TestCase;

class UploadedTest extends TestCase
{
    /** @var Uploaded */
    private $entity;
    /** @var string */
    private $url;
    /** @var PositionInterface */
    private $position;
    /** @var SizesInterface */
    private $sizes;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded::getUrl
     */
    public function testUrl()
    {
        $this->assertSame($this->url, $this->entity->getUrl());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded::getPosition
     */
    public function testPosition()
    {
        $this->assertSame($this->position, $this->entity->getPosition());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded::getSizes
     */
    public function testSizes()
    {
        $this->assertSame($this->sizes, $this->entity->getSizes());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->entity = new Uploaded(
            $this->url = 'test',
            $this->position = $this->createMock(PositionInterface::class),
            $this->sizes = $this->createMock(SizesInterface::class)
        );
    }
}
