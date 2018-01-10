<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\ButtonLogoImage;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\IconLogoSliderImage;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use PHPUnit\Framework\TestCase;

class ImagesTest extends TestCase
{
    /** @var Images */
    private $images;

    /**
     * Mock
     *
     * @var ButtonLogoImage
     */
    private $buttonLogoImage;

    /**
     * Mock
     *
     * @var IconLogoSliderImage
     */
    private $iconLogoSliderImage;

    /**
     * Mock
     *
     * @var BackgroundSliderImage
     */
    private $backgroundSliderImage;

    /**
     * @var array
     */
    private $expectedToAPIResponse;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getButtonLogo
     */
    public function testButtonLogo()
    {
        $this->assertSame(
            $this->buttonLogoImage,
            $this->images->getButtonLogo()
        );
        $this->assertInstanceOf(
            ButtonLogoImage::class,
            $this->images->getButtonLogo()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getIconLogoSlider
     */
    public function testIconLogoSlider()
    {
        $this->assertSame(
            $this->iconLogoSliderImage,
            $this->images->getIconLogoSlider()
        );
        $this->assertInstanceOf(
            IconLogoSliderImage::class,
            $this->images->getIconLogoSlider()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getBackgroundSlider
     */
    public function testGetBackgroundSlider()
    {
        $this->assertSame(
            $this->backgroundSliderImage,
            $this->images->getBackgroundSlider()
        );
        $this->assertInstanceOf(
            BackgroundSliderImage::class,
            $this->images->getBackgroundSlider()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setBackgroundSlider()
     */
    public function testSetBackgroundSlider()
    {
        $image = $this->createMock(BackgroundSliderImage::class);

        $this->images->setBackgroundSlider($image);

        $this->assertSame($image, $this->images->getBackgroundSlider());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::toAPI()
     */
    public function testToAPIAll()
    {
        $this->buttonLogoImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['buttonLogo']);

        $this->iconLogoSliderImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['iconLogoSlider']);

        $this->backgroundSliderImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['backgroundSlider']);

        $this->assertEquals(
            $this->expectedToAPIResponse,
            $this->images->toAPI()
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->images = new Images(
            $this->buttonLogoImage = $this->createMock(
                ButtonLogoImage::class
            ),
            $this->iconLogoSliderImage = $this->createMock(
                IconLogoSliderImage::class
            ),
            $this->backgroundSliderImage = $this->createMock(
                BackgroundSliderImage::class
            )
        );
        $this->expectedToAPIResponse = [
            'buttonLogo'       => '1.png',
            'iconLogoSlider'   => '2.png',
            'backgroundSlider' => '3.png',
        ];
    }
}
