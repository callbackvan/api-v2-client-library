<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

/**
 * Class Channel
 */
class Channel implements BaseEntityInterface
{
    /**
     * @var string
     */
    protected $channelId = '';

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
     * @var boolean
     */
    protected $isEditable = true;

    /**
     * @return string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param string $channelId
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }

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
     * @return bool
     */
    public function isEditable()
    {
        return (bool)$this->isEditable;
    }

    /**
     * @param bool $isEditable
     */
    public function setIsEditable($isEditable)
    {
        $this->isEditable = $isEditable;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'channelId' => $this->getChannelId(),
            'desktopEnabled' => $this->isDesktopEnabled(),
            'mobileEnabled'  => $this->isMobileEnabled(),
        ];
    }
}
