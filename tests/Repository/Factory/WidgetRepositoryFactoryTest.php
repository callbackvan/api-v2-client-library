<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
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
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::make
     */
    public function testMake()
    {
        $userId = 111;
        $key = 'testkey';

        $this->assertInstanceOf(
            WidgetRepository::class,
            $this->widgetRepositoryFactory->make($userId, $key)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = new ClientFactory();
        $this->widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $this->widgetRepositoryFactory = new WidgetRepositoryFactory(
            $this->clientFactory,
            $this->widgetFactory
        );
    }
}
