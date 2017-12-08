<?php

namespace Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use Hoa\Math\Combinatorics\Combination\CartesianProduct;
use PHPUnit\Framework\TestCase;

class ChannelsTest extends TestCase
{
    /** @var Channels */
    private $channels;

    /** @var array */
    private $initialChannels = [];

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get()
     * @param string $channelName
     *
     * @dataProvider provideChannelsList
     */
    public function testGet($channelName)
    {
        $this->invokeMethod($this->channels, 'get', [$channelName]);
    }

    public function provideChannelsList()
    {
        $res = [];
        foreach (Channels::CHANNELS_LIST as $channelName) {
            $res[] = [$channelName];
        }

        return $res;
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity()
     *
     * @param string $channelName
     * @param string $method
     * @param bool $status
     *
     * @dataProvider provideSetActivity
     */
    public function testSetActivity($channelName, $method, $status)
    {
        $this->assertNull($this->channels->setActivity($channelName, $method, $status));
    }

    public function provideSetActivity()
    {
        $res = [];

        $tuples = new CartesianProduct(
            Channels::CHANNELS_LIST,
            ['isMobileEnabled', 'isDesktopEnabled'],
            [true, false]
        );

        foreach ($tuples as $i => $tuple) {
            $res[] = $tuple;
        }

        return $res;
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getBuiltIn()
     */
    public function testGetBuiltIn()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getBuiltIn());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getCallback()
     */
    public function testGetCallback()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getCallback());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getFacebook()
     */
    public function testGetFacebook()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getFacebook());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getSkype()
     */
    public function testGetSkype()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getSkype());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getSMS()
     */
    public function testGetSMS()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getSMS());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getTelegram()
     */
    public function testGetTelegram()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getTelegram());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getViber()
     */
    public function testGetViber()
    {
        $this->assertInstanceOf(ChannelMobileOnly::class, $this->channels->getViber());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getVk()
     */
    public function testGetVk()
    {
        $this->assertInstanceOf(Channel::class, $this->channels->getVk());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity()
     *
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     *
     * @param string $channelName
     * @param string $method
     * @param bool $status
     *
     * @dataProvider provideActivityForUnknownChannel
     */
    public function testSetActivityForUnknownChannel($channelName, $method, $status)
    {
        $this->channels->setActivity(
            $channelName,
            $method,
            $status
        );
    }

    public function provideActivityForUnknownChannel()
    {
        $res = [];

        $tuples = new CartesianProduct(
            ['_channelThatIsUnknown_'],
            ['isMobileEnabled', 'isDesktopEnabled'],
            [true, false]
        );

        foreach ($tuples as $i => $tuple) {
            $res[] = $tuple;
        }

        return $res;
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get()
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testGetWithWrongChannel()
    {
        $this->invokeMethod($this->channels, 'get', ['abrakadabra']);
    }

    public function testToApi()
    {
        $expected = [];
        $oneToApi = [
            'isDesktopEnabled' => true,
            'isMobileEnabled'  => true,
        ];

        foreach (Channels::CHANNELS_LIST as $item) {
            $expected[$item] = [
                'isDesktopEnabled' => true,
                'isMobileEnabled'  => true
            ];
        }

        foreach ($this->initialChannels as $channel) {
            $channel->expects($this->once())->method('toApi')->willReturn($oneToApi);
        }

        $toApiResult = $this->channels->toApi();

        $this->assertEquals($expected, $toApiResult);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->initialChannels = [];

        for ($i = 0; $i < 8; $i++) {
            $this->initialChannels[] = $this->createMock(Channel::class);
        }
        $this->initialChannels[6] = $this->createMock(ChannelMobileOnly::class);


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
