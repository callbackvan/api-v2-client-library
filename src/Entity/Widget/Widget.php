<?php

namespace CallbackHunterAPIv2\Entity\Widget;

use CallbackHunterAPIv2\Entity\Widget\Settings;

class Widget implements WidgetInterface
{
    const WIDGET_LINK_PREFIX   = '//cdn.callbackhunter.com/cbh.js';
    const WIDGET_DETAILED_LINK = 'https://callbackhunter.com/cabinet/hunters/edit/';

    /**
     * Идентификатор виджета
     *
     * @var string
     */
    private $uid;

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
    private $isActive;

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
     * @param Settings\SettingsInterface $settings
     */
    public function __construct(Settings\SettingsInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return string
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
     * @return string
     */
    public function getLink()
    {
        $link = self::WIDGET_LINK_PREFIX;

        if (!empty($this->code)) {
            $link .= '?hunter_code=' . $this->code;
        }

        return $link;
    }

    /**
     * @return string
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
     * @return boolean
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = (bool)$isActive;

        return $this;
    }

    /**
     * @return string
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
     * @return string
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
        return [
            'isActive' => $this->isActive(),
            'site'     => $this->getSite(),
            'settings' => $this->settings->toAPI(),
        ];
    }
}
