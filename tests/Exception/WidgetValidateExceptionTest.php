<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\WidgetValidateException;
use PHPUnit\Framework\TestCase;

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
