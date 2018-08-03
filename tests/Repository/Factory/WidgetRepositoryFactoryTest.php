<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\Client;
use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\WidgetPhoneRepository;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use PHPUnit\Framework\TestCase;

class WidgetRepositoryFactoryTest extends TestCase
{
    /** @var  $widgetFactory */
    private $widgetFactory;
    /** @var  $clientFactory */
    private $clientFactory;
    /** @var  $widgetRepositoryFactory */
    private $widgetRepositoryFactory;

    /**
     * @var WidgetPhoneRepository
     */
    private $phoneRepository;

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::make
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
            WidgetRepository::class,
            $this->widgetRepositoryFactory->make($userId, $key, $config)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::makeSAP
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
            WidgetRepository::class,
            $this->widgetRepositoryFactory->makeSAP($token, $config)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = $this->createMock(ClientFactory::class);
        $this->widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $this->phoneRepository = $this->createMock(WidgetPhoneRepository::class);

        $this->widgetRepositoryFactory = new WidgetRepositoryFactory(
            $this->clientFactory,
            $this->widgetFactory,
            $this->phoneRepository
        );
    }
}
