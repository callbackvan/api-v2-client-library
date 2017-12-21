<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Widget;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use PHPUnit\Framework\TestCase;

class WidgetFactoryTest extends TestCase
{
    /** @var WidgetFactory */
    private $widgetFactory;

    /** @var Factory\SettingsFactory */
    private $settingsFactory;

    /** @var array */
    private $widgetDataSample;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory::fromAPI
     */
    public function testFromAPI()
    {
        $settings = $this->createMock(Settings::class);

        $this->settingsFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->widgetDataSample['settings'])
            ->willReturn($settings);

        $expected = (new Widget\Widget($settings))
            ->setUid($this->widgetDataSample['uid'])
            ->setIsActive($this->widgetDataSample['isActive'])
            ->setSite($this->widgetDataSample['site'])
            ->setCode($this->widgetDataSample['code'])
            ->setWidgetSettingsLink($this->widgetDataSample['_links']['widgetSettings']['href'])
            ->setOperatorChatLink($this->widgetDataSample['_links']['operatorChat']['href']);

        $widget = $this->widgetFactory->fromAPI($this->widgetDataSample);

        $this->assertEquals($expected, $widget);
        $this->assertSame($settings, $widget->getSettings());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->widgetDataSample = [
            'uid'      => '246f6bcd4621d373cade4e832627b4s6',
            'isActive' => true,
            'site'     => 'mysite.com',
            'code'     => '96325feb74992cc3482b350163a1a010',
            'settings' => [
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
            ],
            '_links'   => [
                'self' => [
                    'href' => '/widgets/31dbfcf288e7076e0e891fb644552f78b8a0b0af'
                ],
                'operatorChat' => [
                    'href' => 'https://chat.callbackhunter.com/#key=d6a0ed6440b7788'
                ],
                'widgetSettings' => [
                    'href' => '/cabinet/widgets/31dbfcf288e7076e0e891fb644552f78b8a0b0af'
                ]
            ],
        ];

        $this->settingsFactory = $this->createMock(Factory\SettingsFactory::class);

        $this->widgetFactory = new WidgetFactory($this->settingsFactory);
    }
}
