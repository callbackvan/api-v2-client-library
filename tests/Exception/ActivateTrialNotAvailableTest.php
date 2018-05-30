<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ActivateTrialNotAvailableTest extends TestCase
{
    /** @var ActivateTrialNotAvailable */
    private $exception;

    /** @var string */
    private $message;

    /**
     * @covers \CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable::__construct
     * @covers \CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable::getMessage
     */
    public function testGetMessage()
    {
        $this->assertEquals($this->message, $this->exception->getMessage());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->exception = new ActivateTrialNotAvailable(
            $this->createMock(ResponseInterface::class),
            $this->message= 'some error',
            403
        );
    }
}
