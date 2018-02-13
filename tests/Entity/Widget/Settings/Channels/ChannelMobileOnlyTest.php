<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly;
use PHPUnit\Framework\TestCase;

class ChannelMobileOnlyTest extends TestCase
{
    /** @var Channel */
    private $channel;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::isMobileEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::setMobileEnabled()
     */
    public function testIsMobileEnabled()
    {
        $this->channel->setMobileEnabled(true);
        $this->assertTrue($this->channel->isMobileEnabled());

        $this->channel->setMobileEnabled(false);
        $this->assertFalse($this->channel->isMobileEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::isDesktopEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::setDesktopEnabled()
     */
    public function testIsDesktopEnabled()
    {
        $this->channel->setDesktopEnabled(true);
        $this->assertFalse($this->channel->isDesktopEnabled());

        $this->channel->setDesktopEnabled(false);
        $this->assertFalse($this->channel->isDesktopEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::toAPI()
     */
    public function testToAPIAll()
    {
        $this->channel->setDesktopEnabled(true);
        $this->channel->setMobileEnabled(false);

        $expected = [
            'channelId' => '',
            'mobileEnabled' => false,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::toAPI()
     */
    public function testToAPISingle()
    {
        $this->channel->setMobileEnabled(true);

        $expected = [
            'channelId' => '',
            'mobileEnabled' => true,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channel = new ChannelMobileOnly();
    }
}
