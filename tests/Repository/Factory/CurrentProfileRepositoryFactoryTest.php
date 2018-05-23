<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\CurrentProfileRepository;
use CallbackHunterAPIv2\Repository\Factory\CurrentProfileRepositoryFactory;
use PHPUnit\Framework\TestCase;

class CurrentProfileRepositoryFactoryTest extends TestCase
{
    /** @var ClientFactory $clientFactory */
    private $clientFactory;

    /** @var CurrentProfileRepository $factory */
    private $factory;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\CurrentProfileRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\CurrentProfileRepositoryFactory::make
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
            CurrentProfileRepository::class,
            $this->factory->make($userId, $key, $config)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\CurrentProfileRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\CurrentProfileRepositoryFactory::makeSAP
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
            CurrentProfileRepository::class,
            $this->factory->makeSAP($token, $config)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = $this->createMock(ClientFactory::class);
        $this->factory = new CurrentProfileRepositoryFactory($this->clientFactory);
    }
}
