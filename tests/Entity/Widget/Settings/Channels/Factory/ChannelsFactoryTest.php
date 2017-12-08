<?php

namespace Tests\Entity\Widget\Settings\Channels\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory;
use PHPUnit\Framework\TestCase;

class ChannelsFactoryTest extends TestCase
{
    /** @var Factory\ChannelsFactory */
    private $channelsFactory;

    const AVAILABLE_CHANNELS = Channels\Channels::CHANNELS_LIST;
    const AVAILABLE_PROPERTIES = ['isDesktopEnabled', 'isMobileEnabled'];
    const AVAILABLE_ARGS = [true, false];

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory::fromAPI()
     */
    public function testFromApi()
    {
        $sampleData = $this->generateFromApiSample(1);

        $channels = $this->channelsFactory->fromAPI($sampleData);

        $this->assertInstanceOf(Channels\Channel::class, $channels->getSMS());
        $this->assertInstanceOf(Channels\Channel::class, $channels->getCallback());
        $this->assertInstanceOf(Channels\Channel::class, $channels->getBuiltIn());
        $this->assertInstanceOf(Channels\Channel::class, $channels->getFacebook());
        $this->assertInstanceOf(Channels\Channel::class, $channels->getSkype());
        $this->assertInstanceOf(Channels\Channel::class, $channels->getTelegram());
        $this->assertInstanceOf(Channels\ChannelMobileOnly::class, $channels->getViber());
        $this->assertInstanceOf(Channels\Channel::class, $channels->getVk());
    }

    /**
     * Генератор массива каналов для тестирования fromAPi
     *
     * @param int $numOfChannels сколько каналов задать в массиве из возможных
     *
     * @return array
     */
    protected function generateFromApiSample($numOfChannels = 0)
    {
        $fromApi = [];

        $unknownPropName = 'unknownMethod';

        $randomChannelNames = self::AVAILABLE_CHANNELS;
        $randomPropNames = array_merge(self::AVAILABLE_PROPERTIES, [$unknownPropName]);

        $maxNum = count(self::AVAILABLE_CHANNELS);

        if ((int)$numOfChannels <= 0) {
            $numOfChannels = $maxNum;
        }

        if ((int)$numOfChannels >= $maxNum) {
            $numOfChannels = $maxNum;
        }

        for ($i = 0; $i < $numOfChannels; $i++) {
            shuffle($randomChannelNames);
            $cName = array_shift($randomChannelNames);
            $fromApi[$cName] = [];

            $localRandomPropNames = $randomPropNames;
            $max = count(self::AVAILABLE_PROPERTIES);

            for ($j = 0; $j < $max; $j++) {
                shuffle($localRandomPropNames);
                $prop = array_shift($localRandomPropNames);
                if ($prop !== $unknownPropName) {
                    $fromApi[$cName][$prop] = self::AVAILABLE_ARGS[mt_rand(
                        0, count(self::AVAILABLE_ARGS) - 1
                    )];
                }
            }
        }

        return $fromApi;
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channelsFactory = new Factory\ChannelsFactory();
    }
}
