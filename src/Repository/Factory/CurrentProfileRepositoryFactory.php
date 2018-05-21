<?php

namespace CallbackHunterAPIv2\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\CurrentProfileRepository;

/**
 * Class CurrentProfileRepositoryFactory
 * Фабрика для CallbackHunterAPIv2\Repository\CurrentProfileRepository
 *
 * @package CallbackHunterAPIv2\Repository\Factory
 */
class CurrentProfileRepositoryFactory
{
    /** @var ClientFactory */
    private $clientFactory;

    /**
     * @param ClientFactory $clientFactory
     */
    public function __construct(ClientFactory $clientFactory) {
        $this->clientFactory = $clientFactory;
    }

    /**
     * @param integer $userId
     * @param string  $key
     * @param array   $config
     *
     * @return CurrentProfileRepository
     */
    public function make($userId, $key, array $config = [])
    {
        $client = $this->clientFactory->makeWithAPICredentials(
            $userId,
            $key,
            $config
        );

        return new CurrentProfileRepository($client);
    }

    /**
     * @param string $token
     * @param array  $config
     *
     * @return CurrentProfileRepository
     */
    public function makeSAP($token, array $config = [])
    {
        $client = $this->clientFactory->makeWithSAPCredentials(
            $token,
            $config
        );

        return new CurrentProfileRepository($client);
    }
}
