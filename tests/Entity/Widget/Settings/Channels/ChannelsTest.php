<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnly;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use PHPUnit\Framework\TestCase;

class ChannelsTest extends TestCase
{
    /** @var Channels */
    private $entity;
    /** @var array */
    private $channels = [];

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getCallback
     */
    public function testGetCallback()
    {
        $this->assertSame(
            $this->channels['callback'], $this->entity->getCallback()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getSMS
     */
    public function testGetSMS()
    {
        $this->assertSame($this->channels['sms'], $this->entity->getSMS());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getBuiltIn
     */
    public function testGetBuiltIn()
    {
        $this->assertSame(
            $this->channels['builtIn'], $this->entity->getBuiltIn()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getTelegram
     */
    public function testGetTelegram()
    {
        $this->assertSame(
            $this->channels['telegram'], $this->entity->getTelegram()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getVk
     */
    public function testGetVk()
    {
        $this->assertSame($this->channels['vk'], $this->entity->getVk());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getFacebook
     */
    public function testGetFacebook()
    {
        $this->assertSame(
            $this->channels['facebook'], $this->entity->getFacebook()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getViber
     */
    public function testGetViber()
    {
        $this->assertSame($this->channels['viber'], $this->entity->getViber());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::getSkype
     */
    public function testGetSkype()
    {
        $this->assertSame($this->channels['skype'], $this->entity->getSkype());
    }

    /**
     * @covers       \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity
     * @covers       \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get
     * @dataProvider setActivityProvider
     *
     * @param string $channel
     * @param string $type
     */
    public function testSetActivity($channel, $type)
    {
        $methodName = 'set'.ucfirst($type);

        /** @var \PHPUnit_Framework_MockObject_MockObject $obj */
        $obj = $this->channels[$channel];
        $obj->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo(false));

        $this->entity->setActivity($channel, $type, false);
    }

    public function setActivityProvider()
    {
        return [
            'callback_isDesktopEnabled' => ['callback', 'isDesktopEnabled'],
            'callback_isMobileEnabled'  => ['callback', 'isMobileEnabled'],
            'sms_isDesktopEnabled'      => ['sms', 'isDesktopEnabled'],
            'sms_isMobileEnabled'       => ['sms', 'isMobileEnabled'],
            'builtIn_isDesktopEnabled'  => ['builtIn', 'isDesktopEnabled'],
            'builtIn_isMobileEnabled'   => ['builtIn', 'isMobileEnabled'],
            'telegram_isDesktopEnabled' => ['telegram', 'isDesktopEnabled'],
            'telegram_isMobileEnabled'  => ['telegram', 'isMobileEnabled'],
            'vk_isDesktopEnabled'       => ['vk', 'isDesktopEnabled'],
            'vk_isMobileEnabled'        => ['vk', 'isMobileEnabled'],
            'facebook_isDesktopEnabled' => ['facebook', 'isDesktopEnabled'],
            'facebook_isMobileEnabled'  => ['facebook', 'isMobileEnabled'],
            'viber_isMobileEnabled'     => ['viber', 'isMobileEnabled'],
            'skype_isDesktopEnabled'    => ['skype', 'isDesktopEnabled'],
            'skype_isMobileEnabled'     => ['skype', 'isMobileEnabled'],
        ];
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testSetActivityThrowsUnknownChannel()
    {
        $this->entity->setActivity('test', 'isMobileEnabled', false);
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::setActivity
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::get
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testSetActivityThrowsUnknownKey()
    {
        $this->entity->setActivity('vk', 'isTabletEnabled', false);
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels::toAPI
     */
    public function testToAPI()
    {
        $expected = [];

        /** @var \PHPUnit_Framework_MockObject_MockObject $channel */
        foreach ($this->channels as $channelName => $channel) {
            $expected[$channelName] = [
                'isMobileEnabled'  => mt_rand(0, 100) > 50,
                'isDesktopEnabled' => mt_rand(0, 100) > 50,
            ];

            $channel->expects($this->once())
                ->method('toAPI')
                ->willReturn($expected[$channelName]);
        }

        $this->assertEquals($expected, $this->entity->toAPI());
    }


    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->entity = new Channels(
            $this->channels['callback'] = $this->createMock(Channel::class),
            $this->channels['sms'] = $this->createMock(Channel::class),
            $this->channels['builtIn'] = $this->createMock(Channel::class),
            $this->channels['telegram'] = $this->createMock(Channel::class),
            $this->channels['vk'] = $this->createMock(Channel::class),
            $this->channels['facebook'] = $this->createMock(Channel::class),
            $this->channels['viber'] = $this->createMock(
                ChannelMobileOnly::class
            ),
            $this->channels['skype'] = $this->createMock(Channel::class)
        );
    }
}
