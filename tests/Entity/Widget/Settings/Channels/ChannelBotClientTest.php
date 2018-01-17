<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient;
use PHPUnit\Framework\TestCase;

class ChannelBotClientTest extends TestCase
{
    /** @var ChannelBotClient */
    private $channel;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::isMobileEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::setMobileEnabled()
     */
    public function testIsMobileEnabled()
    {
        $this->channel->setMobileEnabled(true);
        $this->assertTrue(true, $this->channel->isMobileEnabled());

        $this->channel->setMobileEnabled(false);
        $this->assertFalse(false, $this->channel->isMobileEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::isDesktopEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::setDesktopEnabled()
     */
    public function testIsDesktopEnabled()
    {
        $this->channel->setDesktopEnabled(true);
        $this->assertTrue(true, $this->channel->isDesktopEnabled());

        $this->channel->setDesktopEnabled(false);
        $this->assertFalse(false, $this->channel->isDesktopEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::isConnected()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::setIsConnected()
     */
    public function testIsConnected()
    {
        $this->channel->setIsConnected(true);
        $this->assertTrue(true, $this->channel->isConnected());

        $this->channel->setIsConnected(false);
        $this->assertFalse(false, $this->channel->isConnected());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::toAPI()
     */
    public function testToAPIAll()
    {
        $this->channel->setDesktopEnabled(true);
        $this->channel->setMobileEnabled(false);

        $expected = [
            'desktopEnabled' => true,
            'mobileEnabled'  => false,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelBotClient::toAPI()
     */
    public function testToAPISingle()
    {
        $this->channel->setDesktopEnabled(true);

        $expected = [
            'desktopEnabled' => true,
            'mobileEnabled'  => null,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channel = new ChannelBotClient();
    }
}
