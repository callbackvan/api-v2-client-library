<?php

namespace Entity\Widget\Settings\Channels;

class ChannelMobileOnly
{
    /** @var boolean */
    private $isMobileEnabled = true;

    /**
     * @return bool
     */
    public function isMobileEnabled()
    {
        return $this->isMobileEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsMobileEnabled($isEnabled)
    {
        $this->isMobileEnabled = !empty($isEnabled);

        return $this;
    }
}
