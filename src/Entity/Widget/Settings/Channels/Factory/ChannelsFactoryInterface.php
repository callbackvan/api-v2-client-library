<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\ChannelInterface;

interface ChannelsFactoryInterface
{
    /**
     * @param array $data
     *
     * @return ChannelInterface
     */
    public function fromAPI(array $data);
}
