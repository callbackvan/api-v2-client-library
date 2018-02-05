<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\PositionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\SizesInterface;
use CallbackHunterAPIv2\Type\FileForUploadInterface;
use PHPUnit\Framework\TestCase;

class ForUploadTest extends TestCase
{
    /** @var ForUpload */
    private $entity;
    /** @var FileForUploadInterface */
    private $fileForUpload;
    /** @var PositionInterface */
    private $position;
    /** @var SizesInterface */
    private $sizes;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload::getImage
     */
    public function testGetImage()
    {
        $this->assertSame($this->fileForUpload, $this->entity->getImage());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload::getPosition
     */
    public function testGetPosition()
    {
        $this->assertSame($this->position, $this->entity->getPosition());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUpload::getSizes
     */
    public function testGetSizes()
    {
        $this->assertSame($this->sizes, $this->entity->getSizes());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->entity = new ForUpload(
            $this->fileForUpload = $this->createMock(
                FileForUploadInterface::class
            ),
            $this->position = $this->createMock(PositionInterface::class),
            $this->sizes = $this->createMock(SizesInterface::class)
        );
    }
}
