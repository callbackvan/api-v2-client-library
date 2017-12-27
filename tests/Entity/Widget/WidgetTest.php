<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget;

use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use CallbackHunterAPIv2\Entity\Widget\Widget;
use PHPUnit\Framework\TestCase;

class WidgetTest extends TestCase
{
    /** @var Widget */
    private $entity;
    /** @var array */
    private $example;
    /** @var Settings */
    private $settings;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::setActive
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::isActive
     */
    public function testIsActive()
    {
        $this->entity->setActive(true);
        $this->assertTrue($this->entity->isActive());

        $this->entity->setActive(false);
        $this->assertFalse($this->entity->isActive());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getCode()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::setCode()
     */
    public function testCode()
    {
        $this->entity->setCode($this->example['code']);
        $this->assertSame($this->example['code'], $this->entity->getCode());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getUid()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::setUid()
     */
    public function testUid()
    {
        $this->entity->setUid($this->example['uid']);
        $this->assertSame($this->example['uid'], $this->entity->getUid());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getSite()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::setSite()
     */
    public function testSite()
    {
        $this->entity->setSite($this->example['site']);
        $this->assertSame($this->example['site'], $this->entity->getSite());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getSettings
     */
    public function testGetSettings()
    {
        $this->assertSame($this->settings, $this->entity->getSettings());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getLink()
     */
    public function testGetLink()
    {
        $expected = Widget::WIDGET_LINK_PREFIX.'?hunter_code='
            .$this->example['code'];
        $this->entity->setCode($this->example['code']);
        $this->assertSame($expected, $this->entity->getLink());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getWidgetSettingsLink()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::setWidgetSettingsLink()
     */
    public function testWidgetSettingsLink()
    {
        $expected = $this->example['self'];
        $this->assertNull($this->entity->getWidgetSettingsLink());
        $this->entity->setWidgetSettingsLink($expected);
        $this->assertSame($expected, $this->entity->getWidgetSettingsLink());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::setOperatorChatLink()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::getOperatorChatLink()
     */
    public function testOperatorChatLink()
    {
        $expected = $this->example['operatorChat'];
        $this->assertNull($this->entity->getOperatorChatLink());
        $this->entity->setOperatorChatLink($expected);
        $this->assertSame($expected, $this->entity->getOperatorChatLink());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Widget::toAPI()
     */
    public function testToAPI()
    {
        $expected = [
            'active'   => $this->example['active'],
            'site'     => $this->example['site'],
            'settings' => null,
        ];

        $this->entity->setSite($expected['site']);
        $this->entity->setActive($expected['active']);
        $this->entity->setCode($this->example['code']);

        $this->settings
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['settings']);

        $this->assertSame($expected, $this->entity->toAPI());
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
            'active'       => true,
            'site'         => 'example.com',
            'code'         => 'd9729xcv74992cc3482b350163a1a010',
            'self'         => '/api/v2/widgets/1',
            'operatorChat' => 'https://chat.callbackhunter.com/#key=d6a0ed6440',
        ];

        $this->settings = $this->createMock(Settings::class);
        $this->entity = new Widget($this->settings);
    }
}
