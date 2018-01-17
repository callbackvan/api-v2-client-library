<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

/**
 * Class Channel
 */
class ChannelMobileOnly implements BaseEntityInterface
{
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
     * @return array
     */
    public function toAPI()
    {
        return [
            'mobileEnabled'  => $this->isMobileEnabled(),
        ];
    }
}
