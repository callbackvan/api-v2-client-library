<?php

namespace CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactoryInterface;
use CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository;

class UploadedRepositoryFactory
{
    /** @var ClientFactory */
    private $clientFactory;

    /** @var UploadedCollectionFactoryInterface */
    private $uploadedCollectionFactory;

    /** @var UploadedFactoryInterface */
    private $uploadedFactory;

    /**
     * WidgetRepositoryFactory constructor.
     *
     * @param ClientFactory                      $clientFactory
     * @param UploadedCollectionFactoryInterface $uploadedCollectionFactory
     * @param UploadedFactoryInterface           $uploadedFactory
     */
    public function __construct(
        ClientFactory $clientFactory,
        UploadedCollectionFactoryInterface $uploadedCollectionFactory,
        UploadedFactoryInterface $uploadedFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->uploadedCollectionFactory = $uploadedCollectionFactory;
        $this->uploadedFactory = $uploadedFactory;
    }

    /**
     * @param integer $userId
     * @param string  $key
     * @param array   $config
     *
     * @return UploadedRepository
     */
    public function make($userId, $key, array $config = [])
    {
        $client = $this->clientFactory->makeWithAPICredentials(
            $userId,
            $key,
            $config
        );

        return new UploadedRepository(
            $client,
            $this->uploadedCollectionFactory,
            $this->uploadedFactory
        );
    }

    /**
     * @param string $key
     * @param array  $config
     *
     * @return UploadedRepository
     */
    public function makeSAP($key, array $config = [])
    {
        $client = $this->clientFactory->makeWithSAPCredentials(
            $key,
            $config
        );

        return new UploadedRepository(
            $client,
            $this->uploadedCollectionFactory,
            $this->uploadedFactory
        );
    }
}
