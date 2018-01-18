<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelWithConnection;
use PHPUnit\Framework\TestCase;

final class ChannelWithConnectionTest extends TestCase
{
    /** @var ChannelWithConnection */
    private $entity;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelWithConnection::isConnected
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelWithConnection::setConnected
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
        $this->entity = new ChannelWithConnection();
    }
}
