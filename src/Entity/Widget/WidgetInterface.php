<?php

namespace CallbackHunterAPIv2\Entity\Widget;

use CallbackHunterAPIv2\Entity\Collection\PhonesCollection;

interface WidgetInterface extends BaseEntityInterface
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
    public function getAccountUID();

    /**
     * @param string $accountUID
     *
     * @return void
     */
    public function setAccountUID($accountUID);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
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
     *
     * @return void
     */
    public function setSite($site);

    /**
     * @return boolean
     */
    public function isActive();

    /**
     * @param boolean $isActive
     *
     * @return void
     */
    public function setActive($isActive);

    /**
     * @return Settings\SettingsInterface
     */
    public function getSettings();

    /**
     * @return string
     */
    public function getWidgetSettingsLink();

    /**
     * @return string
     */
    public function getOperatorChatLink();

    /**
     * @return PhonesCollection
     */
    public function getPhonesCollection();

    /**
     * @return array
     */
    public function toAPI();
}
