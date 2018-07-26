<?php

namespace CallbackHunterAPIv2\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\WidgetPhoneRepository;

/**
 * Class WidgetPhoneRepositoryFactory
 *
 * @package CallbackHunterAPIv2\Repository\Factory
 */
class WidgetPhoneRepositoryFactory
{
    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * WidgetPhoneRepositoryFactory constructor.
     *
     * @param ClientFactory $clientFactory
     */
    public function __construct(ClientFactory $clientFactory)
    {

        $this->clientFactory = $clientFactory;
    }

    /**
     * @param $userId
     * @param $key
     * @param array $config
     *
     * @return WidgetPhoneRepository
     */
    public function make($userId, $key, array $config = [])
    {
        $client = $this->clientFactory->makeWithAPICredentials(
            $userId,
            $key,
            $config
        );

        return new WidgetPhoneRepository($client);
    }

    /**
     * @param $token
     * @param array $config
     *
     * @return WidgetPhoneRepository
     */
    public function makeSAP($token, array $config = [])
    {
        $client = $this->clientFactory->makeWithSAPCredentials(
            $token,
            $config
        );

        return new WidgetPhoneRepository($client);
    }
}
