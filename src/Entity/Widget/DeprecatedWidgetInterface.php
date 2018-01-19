<?php

namespace CallbackHunterAPIv2\Entity\Widget;

interface DeprecatedWidgetInterface extends BaseEntityInterface
{
    /**
     * @return string
     */
    public function getUid();

    /**
     * @param string $uid
     *
     * @return void
     */
    public function setUid($uid);

    /**
     * @return string
     */
    public function getSite();

    /**
     * @param string $site
     *
     * @return void
     */
    public function setSite($site);

    /**
     * @return string
     */
    public function getWidgetSettingsLink();

    /**
     * @param $widgetSettingsLink
     * @return mixed
     */
    public function setWidgetSettingsLink($widgetSettingsLink);

    /**
     * @return mixed
     */
    public function toAPI();
}
