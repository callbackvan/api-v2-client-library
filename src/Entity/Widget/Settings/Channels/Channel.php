<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

/**
 * Class Channel
 */
class Channel
{
    /**
     * Отображать ли канал связи на десктопе
     *
     * @var bool
     */
    protected $isDesktopEnabled;

    /**
     * Отображать ли канал связи на мобильных устройствах
     *
     * @var bool
     */
    protected $isMobileEnabled;

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

    /**
     * @return boolean
     */
    public function isDesktopEnabled()
    {
        return $this->isDesktopEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsDesktopEnabled($isEnabled)
    {
        $this->isDesktopEnabled = !empty($isEnabled);

        return $this;
    }
}
