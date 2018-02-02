<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget;

use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget;
use PHPUnit\Framework\TestCase;

class DeprecatedWidgetTest extends TestCase
{
    /** @var DeprecatedWidget */
    private $entity;
    /** @var array */
    private $example;


    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget::getUid()
     * @covers \CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget::setUid()
     */
    public function testUid()
    {
        $this->entity->setUid($this->example['uid']);
        $this->assertSame($this->example['uid'], $this->entity->getUid());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget::getSite()
     * @covers \CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget::setSite()
     */
    public function testSite()
    {
        $this->entity->setSite($this->example['site']);
        $this->assertSame($this->example['site'], $this->entity->getSite());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget::getWidgetSettingsLink()
     * @covers \CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget::setWidgetSettingsLink()
     */
    public function testWidgetSettingsLink()
    {
        $expected = $this->example['self'];
        $this->assertNull($this->entity->getWidgetSettingsLink());
        $this->entity->setWidgetSettingsLink($expected);
        $this->assertSame($expected, $this->entity->getWidgetSettingsLink());
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->example = [
            'uid'          => '123f6bcd4621d373cade4e832627b4f6',
            'site'         => 'example.com',
            'self'         => 'callbackhunter.com/cabinet/adsasd5468',
        ];

        $this->entity = new DeprecatedWidget();
    }
}
