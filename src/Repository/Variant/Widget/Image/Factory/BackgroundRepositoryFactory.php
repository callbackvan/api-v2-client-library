<?php

namespace CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactoryInterface;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository;

class BackgroundRepositoryFactory
{
    /** @var ClientFactory */
    private $clientFactory;

    /** @var BackgroundFactoryInterface */
    private $backgroundFactory;

    /**
     * WidgetRepositoryFactory constructor.
     *
     * @param ClientFactory          $clientFactory
     * @param BackgroundFactoryInterface $backgroundFactory
     */
    public function __construct(
        ClientFactory $clientFactory,
        BackgroundFactoryInterface $backgroundFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->backgroundFactory = $backgroundFactory;
    }

    /**
     * @param integer $userId
     * @param string  $key
     * @param array   $config
     *
     * @return BackgroundRepository
     */
    public function make($userId, $key, array $config = [])
    {
        $client = $this->clientFactory->makeWithAPICredentials(
            $userId,
            $key,
            $config
        );

        return new BackgroundRepository($client, $this->backgroundFactory);
    }

    /**
     * @param string $token
     * @param array  $config
     *
     * @return BackgroundRepository
     */
    public function makeSAP($token, array $config = [])
    {
        $client = $this->clientFactory->makeWithSAPCredentials(
            $token,
            $config
        );

        return new BackgroundRepository($client, $this->backgroundFactory);
    }
}
