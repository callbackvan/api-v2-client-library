<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\Factory\TrialRepositoryFactory;
use CallbackHunterAPIv2\Repository\TrialRepository;
use PHPUnit\Framework\TestCase;

class TrialRepositoryFactoryTest extends TestCase
{
    /** @var ClientFactory */
    private $clientFactory;

    /** @var TrialRepositoryFactory */
    private $trialRepositoryFactory;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\TrialRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\TrialRepositoryFactory::make
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
            TrialRepository::class,
            $this->trialRepositoryFactory->make($userId, $key, $config)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\TrialRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\TrialRepositoryFactory::makeSAP
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
            TrialRepository::class,
            $this->trialRepositoryFactory->makeSAP($token, $config)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = $this->createMock(ClientFactory::class);

        $this->trialRepositoryFactory = new TrialRepositoryFactory(
            $this->clientFactory
        );
    }
}
