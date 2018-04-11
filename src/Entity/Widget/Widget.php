<?php

namespace CallbackHunterAPIv2\Entity\Widget;

use CallbackHunterAPIv2\Entity\Widget\Settings\SettingsInterface;

class Widget implements WidgetInterface
{
    const WIDGET_LINK_PREFIX = '//cdn.callbackhunter.com/cbh.js';

    /**
     * Идентификатор виджета
     *
     * @var string
     */
    private $uid;

    /**
     * Идентификатор аккаунта
     *
     * @var string
     */
    private $accountUID;

    /**
     * Hash виджета
     * для использования в script[src]
     *
     * @var string
     */
    private $code;

    /**
     * Сайт для виджета
     *
     * @var string
     */
    private $site;

    /**
     * Активность виджета
     *
     * @var bool
     */
    private $active;

    /**
     * Ссылка на страницу редактирования виджета
     *
     * @var string
     */
    private $widgetSettingsLink;

    /**
     * Ссылка на операторский интерфейс
     *
     * @var string
     */
    private $operatorChatLink;

    /**
     * @var Settings\Settings
     */
    private $settings;

    /**
     * @param SettingsInterface $settings
     */
    public function __construct(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return string|null
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     *
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = (string)$uid;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountUID()
    {
        return $this->accountUID;
    }

    /**
     * @param string $accountUID
     */
    public function setAccountUID($accountUID)
    {
        $this->accountUID = $accountUID;
    }

    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this;
     */
    public function setCode($code)
    {
        $this->code = (string)$code;

        return $this;
    }

    /**
     * Ссылка на ядро виджета
     *
     * @return string|null
     */
    public function getLink()
    {
        $link = self::WIDGET_LINK_PREFIX;

        if (!empty($this->code)) {
            $link .= '?hunter_code='.$this->code;
        }

        return $link;
    }

    /**
     * @return string|null
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     *
     * @return $this;
     */
    public function setSite($site)
    {
        $this->site = (string)$site;

        return $this;
    }

    /**
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = (bool)$active;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWidgetSettingsLink()
    {
        return $this->widgetSettingsLink;
    }

    /**
     * @param $widgetSettingsLink
     *
     * @return $this
     */
    public function setWidgetSettingsLink($widgetSettingsLink)
    {
        $this->widgetSettingsLink = $widgetSettingsLink;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOperatorChatLink()
    {
        return $this->operatorChatLink;
    }

    /**
     * @param string $operatorChatLink
     *
     * @return $this
     */
    public function setOperatorChatLink($operatorChatLink)
    {
        $this->operatorChatLink = $operatorChatLink;

        return $this;
    }

    /**
     * @return Settings\Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        $result = [
            'active'     => $this->isActive(),
            'accountUID' => $this->getAccountUID(),
            'site'       => $this->getSite(),
            'settings'   => $this->settings->toAPI(),
        ];

        return $result;
    }
}
