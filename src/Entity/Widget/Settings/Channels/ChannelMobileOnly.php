<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

class ChannelMobileOnly extends Channel
{
    /**
     * ChannelMobileOnly constructor.
     */
    public function __construct()
    {
        $this->isMobileEnabled = true;
        $this->isDesktopEnabled = false;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsDesktopEnabled($isEnabled)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        $data = parent::toAPI();
        unset($data['isDesktopEnabled']);

        return $data;
    }
}
