<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

class ChannelWithConnection extends Channel
{
    private $connected = false;

    /**
     * @return boolean
     */
    public function isConnected()
    {
        return $this->connected;
    }

    /**
     * @param bool $connected
     */
    public function setConnected($connected)
    {
        $this->connected = $connected;
    }
}
