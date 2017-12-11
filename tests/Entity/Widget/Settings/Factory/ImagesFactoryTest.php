<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\ButtonLogoImage;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use PHPUnit\Framework\TestCase;

class ImagesFactoryTest extends TestCase
{
    /** @var ImagesFactory */
    private $imagesFactory;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory::createImageOfType()
     */
    public function testCreateImageOfKnownType()
    {
        $img = $this->imagesFactory->createImageOfType('buttonLogo');
        $this->assertInstanceOf(ButtonLogoImage::class, $img);
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory::createImageOfType()
     */
    public function testCreateImageOfUKnownType()
    {
        $img = $this->imagesFactory->createImageOfType('abrakadabra');
        $this->assertNull($img);
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $images = $this->imagesFactory->fromAPI($this->example);
        $this->assertInstanceOf(Images::class, $images);
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory::fromAPI()
     */
    public function testButtonLogoFromAPI()
    {
        $images = $this->imagesFactory->fromAPI($this->example);

        $this->assertInstanceOf(ButtonLogoImage::class, $images->getButtonLogo());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->imagesFactory = new ImagesFactory();
        $this->example = [
            'buttonLogo'       => '1.png',
            'iconLogoSlider'   => '2.png',
            'backgroundSlider' => '3.png',
            'imageTest'        => '4.png',
        ];
    }
}
