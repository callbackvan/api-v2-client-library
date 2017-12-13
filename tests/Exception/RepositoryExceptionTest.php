<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\RepositoryException;
use Psr\Http\Message\ResponseInterface;

class RepositoryExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\RepositoryException::__construct
     * @covers \CallbackHunterAPIv2\Exception\RepositoryException::getResponse
     */
    public function testGetResponse()
    {
        $response = $this->createMock(ResponseInterface::class);
        $exception = new RepositoryException($response);
        $this->assertSame($response, $exception->getResponse());
    }
}
