<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use PHPUnit\Framework\TestCase;

class ChannelTest extends TestCase
{
    /** @var Channel */
    private $channel;

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
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::toAPI()
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
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::toAPI()
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

        $this->channel = new Channel();
    }
}
