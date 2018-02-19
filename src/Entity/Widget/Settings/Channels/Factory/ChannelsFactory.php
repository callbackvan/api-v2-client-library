<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory;

use CallbackHunterAPIv2\Entity\Widget\Factory\BaseFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channel;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelMobileOnlyWithConnection;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\ChannelWithConnection;

class ChannelsFactory implements BaseFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Channels
     */
    public function fromAPI(array $data)
    {
        $availableChannels = Channels::CHANNELS_LIST;

        foreach ($availableChannels as $cName) {
            switch ($cName) {
                case 'viber':
                    $availableChannels[$cName] = new ChannelMobileOnlyWithConnection;
                    break;
                case 'vk':
                case 'facebook':
                case 'skype':
                case 'telegram':
                    $availableChannels[$cName] = new ChannelWithConnection;
                    break;
                default:
                    $availableChannels[$cName] = new Channel;
                    break;
            }
        }

        foreach ($availableChannels as $cName => $cObj) {
            if (!isset($data[$cName]) || !is_array($data[$cName])) {
                continue;
            }

            /** @var $data bool[][][] */
            foreach ($data[$cName] as $k => $v) {
                $method = 'set'.ucfirst($k);
                if (is_callable([$cObj, $method])) {
                    $cObj->{$method}($v);
                }
            }
        }

        return new Channels(
            $availableChannels['callback'],
            $availableChannels['sms'],
            $availableChannels['builtIn'],
            $availableChannels['telegram'],
            $availableChannels['vk'],
            $availableChannels['facebook'],
            $availableChannels['viber'],
            $availableChannels['skype']
        );
    }
}
