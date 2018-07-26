<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetPhoneRepositoryFactory;
use CallbackHunterAPIv2\Repository\WidgetPhoneRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class WidgetPhoneRepositoryFactoryTest
 *
 * @package CallbackHunterAPIv2\Tests\Repository\Factory
 */
class WidgetPhoneRepositoryFactoryTest extends TestCase
{
    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @var WidgetPhoneRepositoryFactory
     */
    private $widgetPhoneRepositoryFactory;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetPhoneRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetPhoneRepositoryFactory::make
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
            WidgetPhoneRepository::class,
            $this->widgetPhoneRepositoryFactory->make($userId, $key, $config)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetPhoneRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetPhoneRepositoryFactory::makeSAP
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
            WidgetPhoneRepository::class,
            $this->widgetPhoneRepositoryFactory->makeSAP($token, $config)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->widgetPhoneRepositoryFactory = new WidgetPhoneRepositoryFactory(
            $this->clientFactory = $this->createMock(ClientFactory::class)
        );
    }
}
