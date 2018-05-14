<?php

namespace CallbackHunterAPIv2\Tests\ValueObject;

use CallbackHunterAPIv2\ValueObject\WidgetsFilter;
use PHPUnit\Framework\TestCase;

class WidgetsFilterTest extends TestCase
{
    /** @var WidgetsFilter */
    private $entity;

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\WidgetsFilter::setAccountsIds
     * @covers \CallbackHunterAPIv2\ValueObject\WidgetsFilter::toArray
     */
    public function testSetAccountsIds()
    {
        $data = [1, 2, '3', '154'];
        $this->entity->setAccountsIds($data);
        $info = $this->entity->toArray();

        $this->assertArrayHasKey('accountId', $info);
        $this->assertSame(array_map('intval', $data), $info['accountId']);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\WidgetsFilter::setAccountsSAPUUIDs
     * @covers \CallbackHunterAPIv2\ValueObject\WidgetsFilter::toArray
     */
    public function testSetAccountsSAPUUIDs()
    {
        $data = [md5('test 1'), md5('test2')];
        $this->entity->setAccountsSAPUUIDs($data);
        $info = $this->entity->toArray();

        $this->assertArrayHasKey('accountSAPUUID', $info);
        $this->assertSame($data, $info['accountSAPUUID']);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->entity = new WidgetsFilter();
    }
}
