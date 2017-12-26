<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Colors;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SizesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use CallbackHunterAPIv2\Entity\Widget\Settings\Position;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use CallbackHunterAPIv2\Entity\Widget\Settings\Sizes;
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

        $expected = new Settings(
            $colors,
            $position,
            $images,
            $channels,
            $sizes
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
            'colors'   => [
                'iconBackground'   => 'ccc',
                'backgroundSlider' => 'fff',
            ],
            'position' => [
                'x' => 88,
                'y' => 99,
            ],
            'images'   => [
                'buttonLogo'       => '',
                'iconLogoSlider'   => '',
                'backgroundSlider' => '',
            ],
            'channels' => [
                'callback' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
                'sms'      => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
                'builtIn'  => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
                'telegram' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
                'vk'       => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
                'facebook' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
                'viber'    => [
                    'isMobileEnabled' => true,
                ],
                'skype'    => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled'  => true,
                ],
            ],
            'sizes'    => [
                'button' => 50,
            ],
        ];

        $this->colorsFactory = $this->createMock(Factory\ColorsFactory::class);
        $this->positionFactory = $this->createMock(
            Factory\PositionFactory::class
        );
        $this->imagesFactory = $this->createMock(Factory\ImagesFactory::class);
        $this->channelsFactory = $this->createMock(ChannelsFactory::class);
        $this->sizesFactory = $this->createMock(SizesFactory::class);

        $this->settingsFactory = new Factory\SettingsFactory(
            $this->colorsFactory,
            $this->positionFactory,
            $this->imagesFactory,
            $this->channelsFactory,
            $this->sizesFactory
        );
    }
}
