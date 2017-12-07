<?php

namespace Tests\Exception;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException;

class ChangeOfPaidPropertiesExceptionTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException::__construct()
     * @covers \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException::getInvalidParams()
     */
    public function testGetInvalidParams()
    {
        $msg = 'Some error';
        $invalidParams = [
            'name' => 'test',
            'reason' => 'blablabla',
        ];

        $ex = new ChangeOfPaidPropertiesException($msg, $invalidParams);

        $this->assertEquals($invalidParams, $ex->getInvalidParams());
    }
}
