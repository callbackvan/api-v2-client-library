<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ChangeOfPaidPropertiesExceptionTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException::__construct()
     * @covers \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException::getInvalidParams()
     */
    public function testGetInvalidParams()
    {
        $response = $this->createMock(ResponseInterface::class);
        $msg = 'Some error';
        $invalidParams = [
            'name' => 'test',
            'reason' => 'blablabla',
        ];

        $ex = new ChangeOfPaidPropertiesException(
            $response, $msg, $invalidParams
        );

        $this->assertEquals($invalidParams, $ex->getInvalidParams());
    }
}
