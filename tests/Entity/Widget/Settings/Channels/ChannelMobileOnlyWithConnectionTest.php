<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnlyWithConnection;
use PHPUnit\Framework\TestCase;

final class ChannelMobileOnlyWithConnectionTest extends TestCase
{
    /** @var ChannelMobileOnlyWithConnection */
    private $entity;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnlyWithConnection::isConnected
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnlyWithConnection::setConnected
     */
    public function testConnected()
    {
        $this->assertFalse($this->entity->isConnected());
        $this->entity->setConnected(true);
        $this->assertTrue($this->entity->isConnected());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->entity = new ChannelMobileOnlyWithConnection();
    }
}
