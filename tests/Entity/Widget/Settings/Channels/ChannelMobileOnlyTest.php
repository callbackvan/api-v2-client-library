<?php

namespace Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly;
use PHPUnit\Framework\TestCase;

class ChannelMobileOnlyTest extends TestCase
{
    /** @var Channel */
    private $channel;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::isMobileEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::setIsMobileEnabled()
     */
    public function testIsMobileEnabled()
    {
        $this->channel->setIsMobileEnabled(true);
        $this->assertSame(true, $this->channel->isMobileEnabled());

        $this->channel->setIsMobileEnabled(false);
        $this->assertSame(false, $this->channel->isMobileEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::isDesktopEnabled()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::setIsDesktopEnabled()
     */
    public function testIsDesktopEnabled()
    {
        $this->channel->setIsDesktopEnabled(true);
        $this->assertSame(false, $this->channel->isDesktopEnabled());

        $this->channel->setIsDesktopEnabled(false);
        $this->assertSame(false, $this->channel->isDesktopEnabled());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::toApi()
     */
    public function testToApiAll()
    {
        $this->channel->setIsDesktopEnabled(true);
        $this->channel->setIsMobileEnabled(false);

        $expected = [
            'isDesktopEnabled' => false,
            'isMobileEnabled' => false,
        ];

        $this->assertSame($expected, $this->channel->toApi());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly::toApi()
     */
    public function testToApiSingle()
    {
        $this->channel->setIsMobileEnabled(true);

        $expected = [
            'isDesktopEnabled' => false,
            'isMobileEnabled' => true
        ];

        $this->assertSame($expected, $this->channel->toApi());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channel = new ChannelMobileOnly();
    }
}
