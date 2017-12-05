<?php

namespace Tests\Exception;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\Exception\WidgetValidateException;

class WidgetValidateExceptionTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\WidgetValidateException::__construct()
     * @covers \CallbackHunterAPIv2\Exception\WidgetValidateException::getInvalidParams()
     */
    public function testGetInvalidParams()
    {
        $msg = 'Some error';
        $invalidParams = [
            'name' => 'test',
            'reason' => 'blablabla',
        ];

        $ex = new WidgetValidateException($msg, $invalidParams);

        $this->assertEquals($invalidParams, $ex->getInvalidParams());
    }
}
