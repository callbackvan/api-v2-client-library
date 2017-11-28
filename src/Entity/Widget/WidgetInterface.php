<?php

namespace CallbackHunterAPIv2\Entity\Widget;


interface WidgetInterface
{
    /**
     * @return string
     */
    public function getUid();

    /**
     * @param string $uid
     * @return void
     */
    public function setUid($uid);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return void
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getLink();

    /**
     * @return string
     */
    public function getSite();

    /**
     * @param string $site
     * @return void
     */
    public function setSite($site);

    /**
     * @return boolean
     */
    public function isActive();

    /**
     * @param boolean $isActive
     * @return void
     */
    public function setIsActive($isActive);

    /**
     * @return Settings\SettingsInterface
     */
    public function getSettings();
}
