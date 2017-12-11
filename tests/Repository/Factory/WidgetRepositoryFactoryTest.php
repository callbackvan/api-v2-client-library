<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

use CallbackHunterAPIv2\ClientFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use PHPUnit\Framework\TestCase;

class WidgetRepositoryFactoryTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::__construct
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::make
     */
    public function testMake()
    {
        $userId = 111;
        $key = 'testkey';

        $widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $widgetRepositoryFactory = new WidgetRepositoryFactory(new ClientFactory(), $widgetFactory);

        $this->assertInstanceOf(
            WidgetRepository::class,
            $widgetRepositoryFactory->make($userId, $key)
        );
    }
}
