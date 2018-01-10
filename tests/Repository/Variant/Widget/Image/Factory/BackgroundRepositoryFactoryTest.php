<?php

namespace CallbackHunterAPIv2\Tests\Repository\Variant\Widget\Image\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactoryInterface;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory\BackgroundRepositoryFactory;
use PHPUnit\Framework\TestCase;

/**
 * Фабрика репозиториев
 *
 * @package CallbackHunterAPIv2\Tests\Repository\Variant\Widget\Image\Factory
 */
class BackgroundRepositoryFactoryTest extends TestCase
{
    /**
     * HTTP клиент
     *
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * Фабрика фонов
     *
     * @var BackgroundFactoryInterface
     */
    private $backgroundFactory;

    /**
     * Фабрика репозитория фонов
     *
     * @var BackgroundRepositoryFactory
     */
    private $backgroundRepositoryFactory;

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = $this->createMock(ClientFactory::class);
        $this->backgroundFactory = $this->createMock(BackgroundFactoryInterface::class);

        $this->backgroundRepositoryFactory = new BackgroundRepositoryFactory(
            $this->clientFactory,
            $this->backgroundFactory
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory\BackgroundRepositoryFactory::__construct()
     * @covers \CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory\BackgroundRepositoryFactory::make()
     */
    public function testMake()
    {
        $userId = 'some id';
        $key    = 'some key';
        $config = [
            'some configs'
        ];

        $client = $this->createMock(ClientInterface::class);

        $this->clientFactory->expects($this->once())
            ->method('makeWithAPICredentials')
            ->with($userId, $key, $config)
            ->willReturn($client);

        $response = $this->backgroundRepositoryFactory->make($userId, $key, $config);

        $this->assertInstanceOf(BackgroundRepository::class, $response);
    }
}
