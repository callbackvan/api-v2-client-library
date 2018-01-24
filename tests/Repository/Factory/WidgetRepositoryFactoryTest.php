<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository;
use PHPUnit\Framework\TestCase;

class WidgetRepositoryFactoryTest extends TestCase
{
    /** @var  $widgetFactory */
    private $widgetFactory;
    /** @var  $clientFactory */
    private $clientFactory;
    /** @var  $widgetRepositoryFactory */
    private $widgetRepositoryFactory;
    /** @var  $deprecatedWidgetFactory */
    private $deprecatedWidgetFactory;
    /** @var  $deprecatedWidgetRepositoryFactory */
    private $deprecatedWidgetRepositoryFactory;

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

        $this->assertInstanceOf(
            DeprecatedWidgetRepository::class,
            $this->deprecatedWidgetRepositoryFactory->make($userId, $key)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clientFactory = new ClientFactory();
        $this->widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $this->deprecatedWidgetFactory = $this->createMock(DeprecatedWidgetFactory::class);
        $this->deprecatedWidgetRepositoryFactory = new WidgetRepositoryFactory(
            $this->clientFactory,
            $this->deprecatedWidgetFactory
        );
        $this->widgetRepositoryFactory = new WidgetRepositoryFactory(
            $this->clientFactory,
            $this->widgetFactory
        );
    }
}
