<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Collection\PhonesCollection;
use CallbackHunterAPIv2\Entity\Widget;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Phone\Factory\PhoneFactory;
use CallbackHunterAPIv2\Entity\Widget\Phone\PhoneInterface;
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
     * @var PhonesCollection
     */
    private $phonesCollection;

    /**
     * @var PhoneFactory
     */
    private $phoneFactory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory::fromAPI
     *
     * @throws \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testFromAPI()
    {
        $settings = $this->createMock(Settings::class);

        $this->settingsFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->widgetDataSample['settings'])
            ->willReturn($settings);

        $this->phoneFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($this->widgetDataSample['_embedded']['phones'][0])
            ->willReturn(
                $phone = new Widget\Phone\Phone
            );

        $this->phonesCollection->attach($phone);

        $expected = (new Widget\Widget($settings, $this->phonesCollection))
            ->setUid($this->widgetDataSample['uid'])
            ->setActive($this->widgetDataSample['active'])
            ->setSite($this->widgetDataSample['site'])
            ->setCode($this->widgetDataSample['code'])
            ->setWidgetSettingsLink(
                $this->widgetDataSample['_links']['widgetSettings']['href']
            )
            ->setOperatorChatLink(
                $this->widgetDataSample['_links']['operatorChat']['href']
            );

        $widget = $this->widgetFactory->fromAPI($this->widgetDataSample);

        $this->assertEquals($expected, $widget);
        $this->assertSame($settings, $widget->getSettings());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->widgetDataSample = [
            'uid'      => '246f6bcd4621d373cade4e832627b4s6',
            'active'   => true,
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
                        'mobileEnabled'  => false,
                        'connected'      => true,
                    ],
                    'facebook' => [
                        'desktopEnabled' => false,
                        'mobileEnabled'  => false,
                        'connected'      => false,
                    ],
                    'viber'    => [
                        'mobileEnabled' => true,
                    ],
                    'skype'    => [
                        'desktopEnabled' => true,
                        'mobileEnabled'  => true,
                        'connected'      => true,
                    ],
                ],
            ],
            '_links'   => [
                'self'           => [
                    'href' => '/widgets/31dbfcf288e7076e0e891fb644552f78b8a0b0af',
                ],
                'operatorChat'   => [
                    'href' => 'https://chat.callbackhunter.com/#key=d6a0ed6440b7788',
                ],
                'widgetSettings' => [
                    'href' => '/cabinet/widgets/31dbfcf288e7076e0e891fb644552f78b8a0b0af',
                ],
            ],
            '_embedded' => [
                'phones' => [
                    0 => [
                        'id' => 123,
                        'phone' => '911',
                    ],
                ],
            ],
        ];

        $this->settingsFactory = $this->createMock(
            Factory\SettingsFactory::class
        );

        $this->phonesCollection = new PhonesCollection;
        $this->phoneFactory = $this->createMock(PhoneFactory::class);

        $this->widgetFactory = new WidgetFactory($this->settingsFactory, $this->phoneFactory);
    }
}
