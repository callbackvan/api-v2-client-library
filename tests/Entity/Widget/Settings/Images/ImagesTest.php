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
     * @var ButtonLogoImage
     */
    private $buttonLogoImage;

    /**
     * Mock
     * @var IconLogoSliderImage
     */
    private $iconLogoSliderImage;

    /**
     * Mock
     * @var BackgroundSliderImage
     */
    private $backgroundSliderImage;

    /**
     * @var array
     */
    private $expectedToAPIResponse;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getButtonLogo
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setButtonLogo
     */
    public function testButtonLogo()
    {
        $this->images->setButtonLogo($this->buttonLogoImage);
        $this->assertSame($this->buttonLogoImage, $this->images->getButtonLogo());
        $this->assertInstanceOf(ButtonLogoImage::class, $this->images->getButtonLogo());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getIconLogoSlider
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setIconLogoSlider
     */
    public function testIconLogoSlider()
    {
        $this->images->setIconLogoSlider($this->iconLogoSliderImage);
        $this->assertSame($this->iconLogoSliderImage, $this->images->getIconLogoSlider());
        $this->assertInstanceOf(IconLogoSliderImage::class, $this->images->getIconLogoSlider());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getBackgroundSlider
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setBackgroundSlider
     */
    public function testGetBackgroundSlider()
    {
        $this->images->setBackgroundSlider($this->backgroundSliderImage);
        $this->assertSame($this->backgroundSliderImage, $this->images->getBackgroundSlider());
        $this->assertInstanceOf(BackgroundSliderImage::class, $this->images->getBackgroundSlider());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::toAPI()
     */
    public function testToAPIAll()
    {
        $this->images->setButtonLogo($this->buttonLogoImage);
        $this->buttonLogoImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['buttonLogo']);

        $this->images->setIconLogoSlider($this->iconLogoSliderImage);
        $this->iconLogoSliderImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['iconLogoSlider']);

        $this->images->setBackgroundSlider($this->backgroundSliderImage);
        $this->backgroundSliderImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['backgroundSlider']);

        $this->assertSame($this->expectedToAPIResponse, $this->images->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::toAPI()
     */
    public function testToAPIPartial()
    {
        $this->images->setButtonLogo($this->buttonLogoImage);
        $this->buttonLogoImage
            ->expects($this->once())
            ->method('getName')
            ->willReturn($this->expectedToAPIResponse['buttonLogo']);

        $expected = [
            'buttonLogo' => $this->expectedToAPIResponse['buttonLogo'],
        ];

        $this->assertSame($expected, $this->images->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->buttonLogoImage = $this->createMock(ButtonLogoImage::class);
        $this->iconLogoSliderImage = $this->createMock(IconLogoSliderImage::class);
        $this->backgroundSliderImage = $this->createMock(BackgroundSliderImage::class);

        $this->images = new Images();
        $this->expectedToAPIResponse = [
            'buttonLogo' => '1.png',
            'iconLogoSlider' => '2.png',
            'backgroundSlider' => '3.png',
        ];
    }
}
