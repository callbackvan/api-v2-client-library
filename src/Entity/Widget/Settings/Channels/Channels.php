<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Channels;

use CallbackHunterAPIv2\Entity\Widget\Settings\ChannelInterface;
use CallbackHunterAPIv2\Exception;

class Channels implements ChannelInterface
{
    const CHANNELS_LIST = [
        'callback',
        'sms',
        'builtIn',
        'telegram',
        'vk',
        'facebook',
        'viber',
        'skype',
    ];

    /** @var Channel */
    private $callback;
    /** @var Channel */
    private $sms;
    /** @var Channel */
    private $builtIn;
    /** @var Channel */
    private $telegram;
    /** @var Channel */
    private $vk;
    /** @var Channel */
    private $facebook;
    /** @var ChannelMobileOnly */
    private $viber;
    /** @var Channel */
    private $skype;

    /**
     * @param Channel $callback
     * @param Channel $sms
     * @param Channel $builtIn
     * @param Channel $telegram
     * @param Channel $vk
     * @param Channel $facebook
     * @param ChannelMobileOnly $viber
     * @param Channel $skype
     */
    public function __construct(
        Channel $callback,
        Channel $sms,
        Channel $builtIn,
        Channel $telegram,
        Channel $vk,
        Channel $facebook,
        ChannelMobileOnly $viber,
        Channel $skype
    ) {
        $this->callback = $callback;
        $this->sms = $sms;
        $this->builtIn = $builtIn;
        $this->telegram = $telegram;
        $this->vk = $vk;
        $this->facebook = $facebook;
        $this->viber = $viber;
        $this->skype = $skype;
    }

    /**
     * @return Channel
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return Channel
     */
    public function getSMS()
    {
        return $this->sms;
    }

    /**
     * @return Channel
     */
    public function getBuiltIn()
    {
        return $this->builtIn;
    }

    /**
     * @return Channel
     */
    public function getTelegram()
    {
        return $this->telegram;
    }

    /**
     * @return Channel
     */
    public function getVk()
    {
        return $this->vk;
    }

    /**
     * @return Channel
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @return ChannelMobileOnly
     */
    public function getViber()
    {
        return $this->viber;
    }

    /**
     * @return Channel
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param string $channel
     * @param string $key
     * @param boolean $value
     * @throws Exception\InvalidArgumentException
     */
    public function setActivity($channel, $key, $value)
    {
        $obj = $this->get($channel);

        switch ($key) {
            case 'isMobileEnabled':
                $obj->setIsMobileEnabled($value);
                break;
            case 'isDesktopEnabled':
                if (!method_exists($obj, 'setIsDesktopEnabled')) {
                    throw new Exception\InvalidArgumentException(
                        'Changing of "isDesktopEnabled" not available for ' . $channel
                    );
                }
                $obj->setIsDesktopEnabled($value);
                break;
            default:
                throw new Exception\InvalidArgumentException('Invalid key ' . $key);
        }
    }

    /**
     * @param string $channel
     *
     * @return Channel|ChannelMobileOnly
     * @throws Exception\InvalidArgumentException
     */
    private function get($channel)
    {
        switch (strtolower($channel)) {
            case 'callback':
                $obj = $this->getCallback();
                break;
            case 'sms':
                $obj = $this->getSMS();
                break;
            case strtolower('builtIn'):
                $obj = $this->getBuiltIn();
                break;
            case 'telegram':
                $obj = $this->getTelegram();
                break;
            case 'vk':
                $obj = $this->getVk();
                break;
            case 'facebook':
                $obj = $this->getFacebook();
                break;
            case 'viber':
                $obj = $this->getViber();
                break;
            case 'skype':
                $obj = $this->getSkype();
                break;
            default:
                throw new Exception\InvalidArgumentException('Unknown channel ' . $channel);
        }

        return $obj;
    }

    /**
     * @return array
     */
    public function toApi()
    {
        $result = [];

        foreach (self::CHANNELS_LIST as $cName) {
            try {
                $result[$cName] = $this->get($cName)->toApi();
            } catch (\Exception $e) {
            }
        }

        return $result;
    }
}
