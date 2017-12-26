<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory;
use PHPUnit\Framework\TestCase;

class ChannelsFactoryTest extends TestCase
{
    const AVAILABLE_CHANNELS = Channels\Channels::CHANNELS_LIST;
    const AVAILABLE_PROPERTIES = ['desktopEnabled', 'mobileEnabled'];
    const AVAILABLE_ARGS = [true, false];
    /** @var Factory\ChannelsFactory */
    private $channelsFactory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $sampleData = $this->generateFromAPISample();

        $channels = $this->channelsFactory->fromAPI($sampleData);

        $this->assertInstanceOf(Channels\Channel::class, $channels->getSMS());
        $this->assertInstanceOf(
            Channels\Channel::class,
            $channels->getCallback()
        );
        $this->assertInstanceOf(
            Channels\Channel::class,
            $channels->getBuiltIn()
        );
        $this->assertInstanceOf(
            Channels\Channel::class,
            $channels->getFacebook()
        );
        $this->assertInstanceOf(Channels\Channel::class, $channels->getSkype());
        $this->assertInstanceOf(
            Channels\Channel::class,
            $channels->getTelegram()
        );
        $this->assertInstanceOf(
            Channels\ChannelMobileOnly::class,
            $channels->getViber()
        );
        $this->assertInstanceOf(Channels\Channel::class, $channels->getVk());
    }

    /**
     * Генератор массива каналов для тестирования fromAPi
     *
     * @return array
     */
    protected function generateFromAPISample()
    {
        $fromAPI = [];

        $unknownPropName = 'unknownMethod';

        $randomChannelNames = self::AVAILABLE_CHANNELS;
        $randomPropNames = array_merge(
            self::AVAILABLE_PROPERTIES,
            [$unknownPropName]
        );


        shuffle($randomChannelNames);
        $cName = array_shift($randomChannelNames);
        $fromAPI[$cName] = [];

        $localRandomPropNames = $randomPropNames;
        $max = count(self::AVAILABLE_PROPERTIES);

        for ($j = 0; $j < $max; $j++) {
            shuffle($localRandomPropNames);
            $prop = array_shift($localRandomPropNames);
            if ($prop !== $unknownPropName) {
                $index = mt_rand(0, count(self::AVAILABLE_ARGS) - 1);
                $fromAPI[$cName][$prop] = self::AVAILABLE_ARGS[$index];
            }
        }

        return $fromAPI;
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channelsFactory = new Factory\ChannelsFactory();
    }
}
