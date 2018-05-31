<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Channels\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory;
use PHPUnit\Framework\TestCase;

class ChannelsFactoryTest extends TestCase
{
    const AVAILABLE_CHANNELS = Channels\Channels::CHANNELS_LIST;
    const AVAILABLE_PROPERTIES
        = ['desktopEnabled', 'mobileEnabled', 'connected'];
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

        $this->checkChannel(
            $channels->getSMS(),
            $sampleData['sms']
        );
        $this->checkChannel(
            $channels->getEmail(),
            $sampleData['email']
        );
        $this->checkChannel(
            $channels->getCallback(),
            $sampleData['callback']
        );
        $this->checkChannel(
            $channels->getBuiltIn(),
            $sampleData['builtIn']
        );
        $this->checkChannelWithConnection(
            $channels->getFacebook(),
            $sampleData['facebook']
        );
        $this->checkChannelWithConnection(
            $channels->getSkype(),
            $sampleData['skype']
        );
        $this->checkChannel(
            $channels->getTelegram(),
            $sampleData['telegram']
        );
        $this->checkChannelMobile(
            $channels->getViber(),
            $sampleData['viber']
        );
        $this->checkChannelWithConnection(
            $channels->getVk(),
            $sampleData['vk']
        );
    }

    /**
     * Генератор массива каналов для тестирования fromAPi
     *
     * @return array
     */
    private function generateFromAPISample()
    {
        $fromAPI = [];

        $unknownPropName = 'unknownMethod';

        $randomChannelNames = self::AVAILABLE_CHANNELS;
        $randomPropNames = array_merge(
            self::AVAILABLE_PROPERTIES,
            [$unknownPropName]
        );

        foreach ($randomChannelNames as $cName) {
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
        }

        return $fromAPI;
    }

    protected function setUp()
    {
        parent::setUp();

        $this->channelsFactory = new Factory\ChannelsFactory();
    }

    /**
     * @param Channels\Channel $channel
     * @param array            $props
     */
    private function checkChannel($channel, array $props)
    {
        $this->assertInstanceOf(
            Channels\Channel::class,
            $channel
        );

        if (isset($props['desktopEnabled'])) {
            $this->assertSame(
                $channel->isDesktopEnabled(),
                $props['desktopEnabled']
            );
        }
        if (isset($props['mobileEnabled'])) {
            $this->assertSame(
                $channel->isMobileEnabled(),
                $props['mobileEnabled']
            );
        }
    }

    /**
     * @param Channels\ChannelMobileOnly $channel
     * @param array                      $props
     */
    private function checkChannelMobile($channel, array $props)
    {
        $this->assertInstanceOf(
            Channels\ChannelMobileOnly::class,
            $channel
        );

        if (isset($props['mobileEnabled'])) {
            $this->assertSame(
                $channel->isMobileEnabled(),
                $props['mobileEnabled']
            );
        }
    }

    /**
     * @param Channels\ChannelWithConnection $channel
     * @param array                          $props
     */
    private function checkChannelWithConnection($channel, array $props)
    {
        $this->assertInstanceOf(
            Channels\ChannelWithConnection::class,
            $channel
        );

        if (isset($props['desktopEnabled'])) {
            $this->assertSame(
                $channel->isDesktopEnabled(),
                $props['desktopEnabled']
            );
        }
        if (isset($props['mobileEnabled'])) {
            $this->assertSame(
                $channel->isMobileEnabled(),
                $props['mobileEnabled']
            );
        }
        if (isset($props['connected'])) {
            $this->assertSame($channel->isConnected(), $props['connected']);
        }
    }
}
