<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

/**
 * Class Channel
 */
class Channel implements BaseEntityInterface
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
     * @return bool|null
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
     * @return bool|null
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

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'isDesktopEnabled' => $this->isDesktopEnabled(),
            'isMobileEnabled' => $this->isMobileEnabled(),
        ];
    }
}
