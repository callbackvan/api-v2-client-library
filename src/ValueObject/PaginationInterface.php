<?php

namespace CallbackHunterAPIv2\ValueObject;

interface PaginationInterface
{
    /**
     * @return integer
     */
    public function getOffset();

    /**
     * @param integer $offset
     * @return void
     */
    public function setOffset($offset);

    /**
     * @return integer
     */
    public function getLimit();

    /**
     * @param integer $limit
     * @return void
     */
    public function setLimit($limit);
}
