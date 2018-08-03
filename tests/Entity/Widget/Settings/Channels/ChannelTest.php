<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use PHPUnit\Framework\TestCase;

class ChannelTest extends TestCase
{
    /** @var Channel */
    private $channel;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::getChannelId()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::setChannelId()
     */
    public function testChannelId()
    {
        $channelId = 'test123';

        $this->channel->setChannelId($channelId);
        $this->assertEquals($channelId, $this->channel->getChannelId());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::isMobileEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::setMobileEnabled()
     */
    public function testIsMobileEnabled()
    {
        $this->channel->setMobileEnabled(true);
        $this->assertTrue(true, $this->channel->isMobileEnabled());

        $this->channel->setMobileEnabled(false);
        $this->assertFalse(false, $this->channel->isMobileEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::isDesktopEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::setDesktopEnabled()
     */
    public function testIsDesktopEnabled()
    {
        $this->channel->setDesktopEnabled(true);
        $this->assertTrue(true, $this->channel->isDesktopEnabled());

        $this->channel->setDesktopEnabled(false);
        $this->assertFalse(false, $this->channel->isDesktopEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::setIsEditable
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::isEditable
     */
    public function testIsEditable()
    {
        $this->channel->setIsEditable(true);
        $this->assertTrue(true, $this->channel->isEditable());

        $this->channel->setIsEditable(false);
        $this->assertFalse(false, $this->channel->isEditable());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::toAPI()
     */
    public function testToAPIAll()
    {
        $this->channel->setDesktopEnabled(true);
        $this->channel->setMobileEnabled(false);

        $expected = [
            'channelId' => '',
            'desktopEnabled' => true,
            'mobileEnabled'  => false,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::toAPI()
     */
    public function testToAPISingle()
    {
        $this->channel->setDesktopEnabled(true);

        $expected = [
            'channelId' => '',
            'desktopEnabled' => true,
            'mobileEnabled'  => null,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channel = new Channel();
    }
}
