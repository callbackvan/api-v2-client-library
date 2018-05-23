<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory;
use CallbackHunterAPIv2\Repository\TariffStatusRepository;
use PHPUnit\Framework\TestCase;

class TariffStatusRepositoryFactoryTest extends TestCase
{
    /** @var  $clientFactory */
    private $clientFactory;
    /** @var  $tariffStatusRepositoryFactory */
    private $tariffStatusRepositoryFactory;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory::make
     */
    public function testMake()
    {
        $userId = 111;
        $key = 'testkey';
        $config = ['some' => 'config'];

        $this->clientFactory
            ->expects($this->once())
            ->method('makeWithAPICredentials')
            ->with($userId, $key, $config)
            ->willReturn($client = $this->createMock(Client::class));

        $this->assertInstanceOf(
            TariffStatusRepository::class,
            $this->tariffStatusRepositoryFactory->make($userId, $key, $config)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory::makeSAP
     */
    public function testMakeSAP()
    {
        $token = 'testkey';
        $config = ['some' => 'config'];

        $this->clientFactory
            ->expects($this->once())
            ->method('makeWithSAPCredentials')
            ->with($token, $config)
            ->willReturn($client = $this->createMock(Client::class));

        $this->assertInstanceOf(
            TariffStatusRepository::class,
            $this->tariffStatusRepositoryFactory->makeSAP($token, $config)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = $this->createMock(ClientFactory::class);
        $this->tariffStatusRepositoryFactory = new TariffStatusRepositoryFactory($this->clientFactory);
    }
}
