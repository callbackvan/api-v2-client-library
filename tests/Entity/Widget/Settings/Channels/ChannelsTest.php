<?php

namespace Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly;
use PHPUnit\Framework\TestCase;

class ChannelsTest extends TestCase
{
    /** @var Channels */
    private $channels;

    /** @var array */
    private $initialChannels = [];

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get()
     */
    public function testGet()
    {
        foreach (Channels::CHANNELS_LIST as $channelName) {
            $this->invokeMethod($this->channels, 'get', [$channelName]);
        }
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity()
     */
    public function testSetActivity()
    {
        $methods = ['isMobileEnabled', 'isDesktopEnabled'];
        $status  = [true, false];

        foreach (Channels::CHANNELS_LIST as $channelName) {
            $this->channels->setActivity(
                $channelName,
                $methods[rand(0, count($methods) - 1)],
                $status[rand(0, count($status) - 1)]
            );
        }
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getBuiltIn()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getCallback()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getFacebook()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getSkype()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getSMS()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getTelegram()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getViber()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getVk()
     */
    public function testGetSingleChannel()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getBuiltIn());
        $this->assertInstanceOf(Channel::class, $this->channels->getCallback());
        $this->assertInstanceOf(Channel::class, $this->channels->getFacebook());
        $this->assertInstanceOf(Channel::class, $this->channels->getSkype());
        $this->assertInstanceOf(Channel::class, $this->channels->getSMS());
        $this->assertInstanceOf(Channel::class, $this->channels->getTelegram());
        $this->assertInstanceOf(ChannelMobileOnly::class, $this->channels->getViber());
        $this->assertInstanceOf(Channel::class, $this->channels->getVk());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity()
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testSetActivityForUnknownChannel()
    {
        $methods = ['isMobileEnabled', 'isDesktopEnabled'];
        $status  = [true, false];

        $this->channels->setActivity(
            'sdgfdghfghjgj',
            $methods[rand(0, count($methods) - 1)],
            $status[rand(0, count($status) - 1)]
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get()
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testGetWithWrongKey()
    {
        $this->invokeMethod($this->channels, 'get', ['abrakadabra']);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->initialChannels = [];
        $possibleArg = [true, false];

        for ($i = 0; $i < 8; $i++) {
            $this->initialChannels[] = (new Channel())
                ->setIsDesktopEnabled($possibleArg[rand(0, 1)])
                ->setIsMobileEnabled($possibleArg[rand(0, 1)]);
        }

        $this->initialChannels[6] = (new ChannelMobileOnly())
            ->setIsDesktopEnabled($possibleArg[rand(0, 1)])
            ->setIsMobileEnabled($possibleArg[rand(0, 1)]);

        $this->channels = new Channels(...$this->initialChannels);
    }

    /**
     * Call protected|private method of a class.
     *
     * @param object &$object
     * @param string $methodName
     * @param array  $parameters
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
