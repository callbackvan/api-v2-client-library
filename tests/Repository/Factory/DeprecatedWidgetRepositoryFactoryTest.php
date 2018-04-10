<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory;
use CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository;
use CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory;
use PHPUnit\Framework\TestCase;

class DeprecatedWidgetRepositoryFactoryTest extends TestCase
{
    /** @var  $clientFactory */
    private $clientFactory;
    /** @var  $deprecatedWidgetFactory */
    private $deprecatedWidgetFactory;
    /** @var  $factory */
    private $factory;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory::make
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
            DeprecatedWidgetRepository::class,
            $this->factory->make($userId, $key, $config)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory::makeSAP
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
            DeprecatedWidgetRepository::class,
            $this->factory->makeSAP($token, $config)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new DeprecatedWidgetRepositoryFactory(
            $this->clientFactory = $this->createMock(
                ClientFactory::class
            ),
            $this->deprecatedWidgetFactory = $this->createMock(
                DeprecatedWidgetFactory::class
            )
        );
    }
}
