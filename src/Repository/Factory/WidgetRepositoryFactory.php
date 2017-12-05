<?php

namespace CallbackHunterAPIv2\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ValueObject\Credentials;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;

/**
 * Class WidgetRepositoryFactory
 * Фабрика для CallbackHunterAPIv2\Repository\WidgetRepository
 *
 * @package CallbackHunterAPIv2\Repository\Factory
 */
class WidgetRepositoryFactory
{
    /**
     * @param integer $userId
     * @param string $key
     * @return WidgetRepository
     */
    public static function make($userId, $key)
    {
        $credentials = new Credentials($userId, $key);
        $client = new Client(new \GuzzleHttp\Client, $credentials);
        $widgetFactory = new WidgetFactory();

        return new WidgetRepository($client, $widgetFactory);
    }
}
