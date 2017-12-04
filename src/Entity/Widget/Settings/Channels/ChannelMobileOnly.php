<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

class ChannelMobileOnly extends Channel
{
    /** @var boolean */
    protected $isMobileEnabled = true;

    /** @var boolean */
    protected $isDesktopEnabled = false;

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsDesktopEnabled($isEnabled)
    {
        return $this;
    }
}
