<?php

namespace CallbackHunterAPIv2\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository;

/**
 * Class WidgetRepositoryFactory
 * Фабрика для CallbackHunterAPIv2\Repository\WidgetRepository
 *
 * @package CallbackHunterAPIv2\Repository\Factory
 */
class DeprecatedWidgetRepositoryFactory
{
    /** @var ClientFactory */
    private $clientFactory;

    /** @var WidgetFactoryInterface */
    private $widgetFactory;

    /**
     * WidgetRepositoryFactory constructor.
     *
     * @param ClientFactory          $clientFactory
     * @param WidgetFactoryInterface $widgetFactory
     */
    public function __construct(
        ClientFactory $clientFactory,
        WidgetFactoryInterface $widgetFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->widgetFactory = $widgetFactory;
    }

    /**
     * @param integer $userId
     * @param string  $key
     * @param array   $config
     *
     * @return DeprecatedWidgetRepository
     */
    public function make($userId, $key, array $config = [])
    {
        $client = $this->clientFactory->makeWithAPICredentials(
            $userId,
            $key,
            $config
        );

        return new DeprecatedWidgetRepository($client, $this->widgetFactory);
    }
}
