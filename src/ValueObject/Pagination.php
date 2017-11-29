<?php

namespace CallbackHunterAPIv2\ValueObject;

use CallbackHunterAPIv2\Exception;

class Pagination implements PaginationInterface
{
    const DEFAULT_LIMIT = 10;
    const MIN_LIMIT = 0;
    const MAX_LIMIT = 50;
    const DEFAULT_OFFSET = 0;
    const MIN_OFFSET = 0;

    /** @var integer */
    private $offset = self::DEFAULT_OFFSET;

    /** @var integer */
    private $limit = self::DEFAULT_LIMIT;

    /**
     * @return integer
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param integer $offset
     * @return void
     * @throws Exception\ValidateException
     */
    public function setOffset($offset)
    {
        $this->checkNumber($offset, self::MIN_OFFSET);
        $this->offset = $offset;
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param integer $limit
     * @return void
     * @throws Exception\ValidateException
     */
    public function setLimit($limit)
    {
        $this->checkNumber($limit, self::MIN_LIMIT, self::MAX_LIMIT);
        $this->limit = $limit;
    }

    /**
     * @param integer $number
     * @param integer $min
     * @param integer $max
     * @throws Exception\ValidateException
     */
    private function checkNumber($number, $min = null, $max = null)
    {
        $integer = (int)$number;

        if (($min !== null) && ($integer < (int)$min)) {
            throw new Exception\ValidateException(sprintf('"%s" is less min value', $number));
        }

        if (($max !== null) && ($integer > (int)$max)) {
            throw new Exception\ValidateException(sprintf('"%s" is greater max value', $number));
        }
    }
}
