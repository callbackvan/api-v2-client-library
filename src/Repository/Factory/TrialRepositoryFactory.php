<?php

namespace CallbackHunterAPIv2\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\TrialRepository;

class TrialRepositoryFactory
{
    /** @var ClientFactory */
    private $clientFactory;

    /**
     * TrialRepositoryFactory constructor.
     * @param ClientFactory $client
     */
    public function __construct(ClientFactory $client)
    {
        $this->clientFactory = $client;
    }

    /**
     * @param $userId
     * @param $key
     * @param array $config
     *
     * @return TrialRepository
     */
    public function make($userId, $key, array $config = [])
    {
        $client = $this->clientFactory->makeWithAPICredentials(
            $userId,
            $key,
            $config
        );

        return new TrialRepository($client);
    }

    /**
     * @param $token
     * @param array $config
     *
     * @return TrialRepository
     */
    public function makeSAP($token, array $config = [])
    {
        $client = $this->clientFactory->makeWithSAPCredentials(
            $token,
            $config
        );

        return new TrialRepository($client);
    }

}
