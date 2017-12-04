<?php

namespace Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\ValueObject\Pagination;

/**
 * Class PaginationTest
 * @package Tests\ValueObject
 * @covers \CallbackHunterAPIv2\ValueObject\Pagination
 */
class PaginationTest extends TestCase
{
    /** @var Pagination  */
    private $pagination;

    public function testSetOffset()
    {
        $newOffset = 5;
        $this->pagination->setOffset($newOffset);

        $this->assertEquals($newOffset, $this->pagination->getOffset());
    }

    public function testSetLimit()
    {
        $newLimit = 15;
        $this->pagination->setLimit($newLimit);

        $this->assertEquals($newLimit, $this->pagination->getLimit());
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\ValidateException
     */
    public function testSetLimitThrowValidateExceptionWithParamGreaterMaxLimit()
    {
        $number = Pagination::MAX_LIMIT + 1;
        $this->pagination->setLimit($number);
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\ValidateException
     */
    public function testSetLimitThrowValidateExceptionWithParamLessMinLimit()
    {
        $number = Pagination::MIN_LIMIT - 1;
        $this->pagination->setLimit($number);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->pagination = new Pagination();
    }
}
