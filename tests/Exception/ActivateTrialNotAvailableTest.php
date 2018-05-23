<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ActivateTrialNotAvailableTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable::__construct()
     * @covers \CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable::getInvalidParams()
     */
    public function testGetInvalidParams()
    {
        $response = $this->createMock(ResponseInterface::class);
        $msg = 'Some error';
        $invalidParams = [
            'name'   => 'test',
            'reason' => '12345',
        ];

        $ex = new ActivateTrialNotAvailable($response, $msg, $invalidParams);

        $this->assertEquals($invalidParams, $ex->getInvalidParams());
    }
}
