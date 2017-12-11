<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImageForUploadFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory;
use CallbackHunterAPIv2\Type\FileForUploadInterface;
use PHPUnit\Framework\TestCase;

class ImageForUploadFactoryTest extends TestCase
{
    /** @var ImagesFactory */
    private $imageForUploadFactory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImageForUploadFactory::createFromPath
     */
    public function testCreateImageOfTypeAndPath()
    {
        $file = __DIR__ . '/img/test.png';

        $this->assertFileExists($file);
        $this->assertFileIsReadable($file);

        $this->assertInstanceOf(
            FileForUploadInterface::class,
            $this->imageForUploadFactory->createFromPath($file)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->imageForUploadFactory = new ImageForUploadFactory();
    }
}
