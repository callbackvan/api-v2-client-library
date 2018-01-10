<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Colors;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SizesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\TextsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use CallbackHunterAPIv2\Entity\Widget\Settings\Position;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use CallbackHunterAPIv2\Entity\Widget\Settings\Sizes;
use CallbackHunterAPIv2\Entity\Widget\Settings\Texts;
use PHPUnit\Framework\TestCase;

class SettingsFactoryTest extends TestCase
{
    /**
     * @var Factory\SettingsFactory
     */
    private $settingsFactory;

    /**
     * @var array
     */
    private $settingsSample = [];

    /**
     * @var Factory\ColorsFactory
     */
    private $colorsFactory;

    /**
     * @var Factory\PositionFactory
     */
    private $positionFactory;

    /**
     * @var Factory\ImagesFactory
     */
    private $imagesFactory;

    /**
     * @var ChannelsFactory
     */
    private $channelsFactory;

    /**
     * @var SizesFactory
     */
    private $sizesFactory;

    /**
     * @var TextsFactory
     */
    private $textsFactory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory::fromAPI
     */
    public function testFromAPI()
    {
        $colors = $this->createMock(Colors::class);
        $position = $this->createMock(Position::class);
        $images = $this->createMock(Images::class);
        $channels = $this->createMock(Channels::class);
        $sizes = $this->createMock(Sizes::class);
        $texts = $this->createMock(Texts::class);

        $this->colorsFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->settingsSample['colors'])
            ->willReturn($colors);

        $this->positionFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->settingsSample['position'])
            ->willReturn($position);

        $this->imagesFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->settingsSample['images'])
            ->willReturn($images);

        $this->channelsFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->settingsSample['channels'])
            ->willReturn($channels);

        $this->sizesFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->settingsSample['sizes'])
            ->willReturn($sizes);

        $this->textsFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->settingsSample['texts'])
            ->willReturn($texts);

        $expected = new Settings(
            $colors,
            $position,
            $images,
            $channels,
            $sizes,
            $texts
        );
        $expected->setBackgroundTypeForSlider(
            $this->settingsSample['backgroundTypeForSlider']
        );

        $settings = $this->settingsFactory->fromAPI($this->settingsSample);

        $this->assertEquals($expected, $settings);

        $this->assertSame($colors, $settings->getColors());
        $this->assertSame($position, $settings->getPosition());
        $this->assertSame($images, $settings->getImages());
        $this->assertSame($channels, $settings->getChannels());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->settingsSample = [
            'backgroundTypeForSlider' => 'preset',
            'colors'                  => [
                'iconBackground'   => 'ccc',
                'backgroundSlider' => 'fff',
            ],
            'position'                => [
                'x' => 88,
                'y' => 99,
            ],
            'images'                  => [
                'buttonLogo'       => '',
                'iconLogoSlider'   => '',
                'backgroundSlider' => '',
            ],
            'channels'                => [
                'callback' => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
                'sms'      => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
                'builtIn'  => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
                'telegram' => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
                'vk'       => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
                'facebook' => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
                'viber'    => [
                    'mobileEnabled' => true,
                ],
                'skype'    => [
                    'desktopEnabled' => true,
                    'mobileEnabled'  => true,
                ],
            ],
            'sizes'                   => [
                'button' => 50,
            ],
            'texts'    => [
                'sliderCallbackButton' => 'Очень жду!',
                'sliderTitle' => 'Привет!',
            ],
        ];

        $this->colorsFactory = $this->createMock(Factory\ColorsFactory::class);
        $this->positionFactory = $this->createMock(
            Factory\PositionFactory::class
        );
        $this->imagesFactory = $this->createMock(Factory\ImagesFactory::class);
        $this->channelsFactory = $this->createMock(ChannelsFactory::class);
        $this->sizesFactory = $this->createMock(SizesFactory::class);
        $this->textsFactory = $this->createMock(TextsFactory::class);

        $this->settingsFactory = new Factory\SettingsFactory(
            $this->colorsFactory,
            $this->positionFactory,
            $this->imagesFactory,
            $this->channelsFactory,
            $this->sizesFactory,
            $this->textsFactory
        );
    }
}
