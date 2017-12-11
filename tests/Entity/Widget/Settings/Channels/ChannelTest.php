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
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::setIsMobileEnabled()
     */
    public function testIsMobileEnabled()
    {
        $this->channel->setIsMobileEnabled(true);
        $this->assertTrue(true, $this->channel->isMobileEnabled());

        $this->channel->setIsMobileEnabled(false);
        $this->assertFalse(false, $this->channel->isMobileEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::isDesktopEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::setIsDesktopEnabled()
     */
    public function testIsDesktopEnabled()
    {
        $this->channel->setIsDesktopEnabled(true);
        $this->assertTrue(true, $this->channel->isDesktopEnabled());

        $this->channel->setIsDesktopEnabled(false);
        $this->assertFalse(false, $this->channel->isDesktopEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::toAPI()
     */
    public function testToAPIAll()
    {
        $this->channel->setIsDesktopEnabled(true);
        $this->channel->setIsMobileEnabled(false);

        $expected = [
            'isDesktopEnabled' => true,
            'isMobileEnabled' => false,
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel::toAPI()
     */
    public function testToAPISingle()
    {
        $this->channel->setIsDesktopEnabled(true);

        $expected = [
            'isDesktopEnabled' => true,
            'isMobileEnabled' => null
        ];

        $this->assertSame($expected, $this->channel->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channel = new Channel();
    }
}
