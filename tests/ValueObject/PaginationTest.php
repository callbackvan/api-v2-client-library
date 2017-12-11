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

    /**
     * @covers       \CallbackHunterAPIv2\ValueObject\Pagination::nextPage
     * @uses         \CallbackHunterAPIv2\ValueObject\Pagination::setLimit
     * @uses         \CallbackHunterAPIv2\ValueObject\Pagination::setOffset
     * @uses         \CallbackHunterAPIv2\ValueObject\Pagination::getOffset
     *
     * @param $limit
     * @param $offset
     * @param $expectedOffset
     *
     * @dataProvider nextPageProvider
     */
    public function testNextPage($limit, $offset, $expectedOffset)
    {
        $this->pagination->setLimit($limit);
        $this->pagination->setOffset($offset);
        $this->pagination->nextPage();

        $this->assertSame($expectedOffset, $this->pagination->getOffset());
    }

    public function nextPageProvider()
    {
        return [
            [10, 0, 10],
            [10, 100, 110],
            [10, 12, 22],
            [1, 21, 22],
        ];
    }

    protected function setUp()
    {
        parent::setUp();

        $this->pagination = new Pagination();
    }
}
