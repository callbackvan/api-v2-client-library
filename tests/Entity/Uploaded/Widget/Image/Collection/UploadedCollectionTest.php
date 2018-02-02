<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image\Collection;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use PHPUnit\Framework\TestCase;

class UploadedCollectionTest extends TestCase
{
    /** @var UploadedCollection */
    private $collection;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::getButtonLogo
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::add
     */
    public function testGetButtonLogo()
    {
        $data = $this->collection->getButtonLogo();
        $this->assertInternalType('array', $data);
        $this->assertCount(0, $data);
        $file = $this->createMock(UploadedInterface::class);
        $this->collection->add(UploadedCollection::TYPE_BUTTON_LOGO, $file);
        $data = $this->collection->getButtonLogo();
        $this->assertInternalType('array', $data);
        $this->assertCount(1, $data);
        $this->assertSame($file, reset($data));
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::getIconLogoSlider
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::add
     */
    public function testGetIconLogoSlider()
    {
        $data = $this->collection->getIconLogoSlider();
        $this->assertInternalType('array', $data);
        $this->assertCount(0, $data);
        $file = $this->createMock(UploadedInterface::class);
        $this->collection->add(
            UploadedCollection::TYPE_ICON_LOGO_SLIDER,
            $file
        );
        $data = $this->collection->getIconLogoSlider();
        $this->assertInternalType('array', $data);
        $this->assertCount(1, $data);
        $this->assertSame($file, reset($data));
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::getBackgroundSlider
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::add
     */
    public function testGetBackgroundSlider()
    {
        $data = $this->collection->getBackgroundSlider();
        $this->assertInternalType('array', $data);
        $this->assertCount(0, $data);
        $file = $this->createMock(UploadedInterface::class);
        $this->collection->add(
            UploadedCollection::TYPE_BACKGROUND_SLIDER,
            $file
        );
        $data = $this->collection->getBackgroundSlider();
        $this->assertInternalType('array', $data);
        $this->assertCount(1, $data);
        $this->assertSame($file, reset($data));
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection::add
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testAddThrowsExceptionOnInvalidType()
    {
        $file = $this->createMock(UploadedInterface::class);
        $this->collection->add('test', $file);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->collection = new UploadedCollection();
    }
}
