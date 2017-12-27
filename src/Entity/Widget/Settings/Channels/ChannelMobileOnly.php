<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

class ChannelMobileOnly extends Channel
{
    /**
     * ChannelMobileOnly constructor.
     */
    public function __construct()
    {
        $this->mobileEnabled = true;
        $this->desktopEnabled = false;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setDesktopEnabled($isEnabled)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        $data = parent::toAPI();
        unset($data['desktopEnabled']);

        return $data;
    }
}
