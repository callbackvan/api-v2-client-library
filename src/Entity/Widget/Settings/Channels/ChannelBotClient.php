<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

/**
 * Class Channel
 */
class ChannelBotClient implements BaseEntityInterface
{
    /**
     * Список каналов подключаемых через bot-client
     */
    const CHANNELS_BOT_CLIENT = [
        'vk',
        'facebook',
        'skype',
    ];

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
     * Подключен ли канал (только ВК, Fb, Skype)
     *
     * @var bool
     */
    protected $isConnected;

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
    public function isConnected()
    {
        return $this->isConnected;
    }

    /**
     * @param $isConnected
     *
     * @return $this
     */
    public function setIsConnected($isConnected)
    {
        $this->isConnected = $isConnected;

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
