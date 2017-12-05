<?php

namespace Tests\Repository\Factory;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;

class WidgetRepositoryFactoryTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory::make
     */
    public function testMake()
    {
        $userId = 111;
        $key = 'testkey';

        $this->assertInstanceOf(
            WidgetRepository::class,
            WidgetRepositoryFactory::make($userId, $key)
        );
    }
}
