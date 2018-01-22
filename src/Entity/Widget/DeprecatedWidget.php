<?php

namespace CallbackHunterAPIv2\Entity\Widget;

class DeprecatedWidget implements DeprecatedWidgetInterface
{
    const WIDGET_LINK_PREFIX = '//cdn.callbackhunter.com/cbh.js';

    /**
     * Идентификатор виджета
     *
     * @var string
     */
    private $uid;

    /**
     * Сайт для виджета
     *
     * @var string
     */
    private $site;

    /**
     * Ссылка на страницу редактирования виджета
     *
     * @var string
     */
    private $widgetSettingsLink;

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
     * @return bool
     */
    public function toAPI()
    {
        return false;
    }
}
