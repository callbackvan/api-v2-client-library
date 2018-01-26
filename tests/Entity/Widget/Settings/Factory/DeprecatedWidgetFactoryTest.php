<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidgetInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory;
use PHPUnit\Framework\TestCase;

class DeprecatedWidgetFactoryTest extends TestCase
{
    /** @var DeprecatedWidgetFactory */
    private $widgetFactory;

    /** @var array */
    private $widgetDataSample;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory::fromAPI
     */
    public function testFromAPI()
    {
        $widget = $this->widgetFactory->fromAPI($this->widgetDataSample);
        $this->assertInstanceOf(DeprecatedWidgetInterface::class, $widget);
        $this->assertEquals($this->widgetDataSample['uid'], $widget->getUid());
        $this->assertEquals($this->widgetDataSample['site'], $widget->getSite());
        $this->assertEquals(
            $this->widgetDataSample['_links']['widgetSettings']['href'],
            $widget->getWidgetSettingsLink()
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->widgetDataSample = [
            'uid'      => '246f6bcd4621d373cade4e832627b4s6',
            'site'     => 'mysite.com',
            '_links'   => [
                'widgetSettings' => [
                    'href' => '/cabinet/widgets/31dbfcf288e7076e0e891fb644552f78b8a0b0af',
                ],
            ],
        ];

        $this->widgetFactory = new DeprecatedWidgetFactory();
    }
}
