<?php

namespace CallbackHunterAPIv2\Tests\Repository\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactoryInterface;
use CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\Factory\UploadedRepositoryFactory;
use CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository;
use PHPUnit\Framework\TestCase;

class UploadedRepositoryFactoryTest extends TestCase
{
    /**
     * HTTP клиент
     *
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * Фабрика загруженных изображений
     *
     * @var UploadedFactoryInterface
     */
    private $uploadedFactory;

    /**
     * @var UploadedCollectionFactoryInterface
     */
    private $uploadedCollectionFactory;

    /**
     * Фабрика репозитория загруженных изображений
     *
     * @var UploadedRepositoryFactory
     */
    private $uploadedRepositoryFactory;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\Factory\UploadedRepositoryFactory::__construct()
     * @covers \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\Factory\UploadedRepositoryFactory::make()
     */
    public function testMake()
    {
        $userId = 'some id';
        $key = 'some key';
        $config = [
            'some configs',
        ];

        $client = $this->createMock(ClientInterface::class);

        $this->clientFactory->expects($this->once())
            ->method('makeWithAPICredentials')
            ->with($userId, $key, $config)
            ->willReturn($client);

        $response = $this->uploadedRepositoryFactory->make(
            $userId,
            $key,
            $config
        );

        $this->assertInstanceOf(UploadedRepository::class, $response);
    }

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = $this->createMock(ClientFactory::class);
        $this->uploadedCollectionFactory = $this->createMock(
            UploadedCollectionFactoryInterface::class
        );
        $this->uploadedFactory = $this->createMock(
            UploadedFactoryInterface::class
        );

        $this->uploadedRepositoryFactory = new UploadedRepositoryFactory(
            $this->clientFactory,
            $this->uploadedCollectionFactory,
            $this->uploadedFactory
        );
    }
}
