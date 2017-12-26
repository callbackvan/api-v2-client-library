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
    protected $desktopEnabled;

    /**
     * Отображать ли канал связи на мобильных устройствах
     *
     * @var bool
     */
    protected $mobileEnabled;

    /**
     * @return bool|null
     */
    public function isMobileEnabled()
    {
        return $this->mobileEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setMobileEnabled($isEnabled)
    {
        $this->mobileEnabled = !empty($isEnabled);

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isDesktopEnabled()
    {
        return $this->desktopEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setDesktopEnabled($isEnabled)
    {
        $this->desktopEnabled = !empty($isEnabled);

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'desktopEnabled' => $this->isDesktopEnabled(),
            'mobileEnabled'  => $this->isMobileEnabled(),
        ];
    }
}
