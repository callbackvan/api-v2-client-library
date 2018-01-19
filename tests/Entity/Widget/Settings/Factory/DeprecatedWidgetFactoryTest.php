<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget;
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

        $expected = (new DeprecatedWidget())
            ->setUid($this->widgetDataSample['uid'])
            ->setSite($this->widgetDataSample['site'])
            ->setWidgetSettingsLink(
                $this->widgetDataSample['_links']['widgetSettings']['href']
            );

        $widget = $this->widgetFactory->fromAPI($this->widgetDataSample);

        $this->assertEquals($expected, $widget);
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
