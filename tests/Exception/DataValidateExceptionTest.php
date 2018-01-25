<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\DataValidateException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class DataValidateExceptionTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\DataValidateException::__construct()
     * @covers \CallbackHunterAPIv2\Exception\DataValidateException::getInvalidParams()
     */
    public function testGetInvalidParams()
    {
        $response = $this->createMock(ResponseInterface::class);
        $msg = 'Some error';
        $invalidParams = [
            'name'   => 'test',
            'reason' => 'blablabla',
        ];

        $ex = new DataValidateException($response, $msg, $invalidParams);

        $this->assertEquals($invalidParams, $ex->getInvalidParams());
    }
}
