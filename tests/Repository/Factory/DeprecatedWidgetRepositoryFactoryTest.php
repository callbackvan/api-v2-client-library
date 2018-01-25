<?php

namespace CallbackHunterAPIv2\Tests\Repository\Factory;

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

        $this->assertInstanceOf(
            DeprecatedWidgetRepository::class,
            $this->factory->make($userId, $key)
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new DeprecatedWidgetRepositoryFactory(
            $this->clientFactory = new ClientFactory(),
            $this->deprecatedWidgetFactory = $this->createMock(
                DeprecatedWidgetFactory::class
            )
        );
    }
}
