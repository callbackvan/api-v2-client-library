<?php

namespace CallbackHunterAPIv2\Tests\ValueObject;

use CallbackHunterAPIv2\ValueObject\Pagination;
use PHPUnit\Framework\TestCase;

/**
 * Class PaginationTest
 * @package Tests\ValueObject
 */
class PaginationTest extends TestCase
{
    /** @var Pagination  */
    private $pagination;

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::setOffset
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::getOffset
     */
    public function testSetOffset()
    {
        $newOffset = 5;
        $this->pagination->setOffset($newOffset);

        $this->assertEquals($newOffset, $this->pagination->getOffset());
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::setLimit
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::getLimit
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::checkNumber
     */
    public function testSetLimit()
    {
        $newLimit = 15;
        $this->pagination->setLimit($newLimit);

        $this->assertEquals($newLimit, $this->pagination->getLimit());
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::setLimit
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::checkNumber
     * @expectedException \CallbackHunterAPIv2\Exception\ValidateException
     */
    public function testSetLimitThrowValidateExceptionWithParamGreaterMaxLimit()
    {
        $number = Pagination::MAX_LIMIT + 1;
        $this->pagination->setLimit($number);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::setLimit
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::checkNumber
     * @expectedException \CallbackHunterAPIv2\Exception\ValidateException
     */
    public function testSetLimitThrowValidateExceptionWithParamLessMinLimit()
    {
        $number = Pagination::MIN_LIMIT - 1;
        $this->pagination->setLimit($number);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Pagination::setOffset
     * @expectedException \CallbackHunterAPIv2\Exception\ValidateException
     */
    public function testSetOffsetThrowValidateExceptionWithParamLessMinLimit()
    {
        $number = Pagination::MIN_LIMIT - 1;
        $this->pagination->setOffset($number);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->pagination = new Pagination();
    }
}
