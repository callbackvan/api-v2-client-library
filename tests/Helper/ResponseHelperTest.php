<?php

namespace CallbackHunterAPIv2\Tests\Helper;

use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\Helper\ResponseHelper;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ResponseHelperTest extends TestCase
{
    /** @var ResponseInterface */
    private $response;

    /**
     * @covers       \CallbackHunterAPIv2\Helper\ResponseHelper::extractException
     * @dataProvider extractExceptionProvider
     *
     * @param integer    $status
     * @param string     $body
     * @param array|null $expected
     */
    public function testExtractException($status, $body, $expected)
    {
        $validStatuses = [200, 201];
        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($status);

        $isValidStatus = in_array($status, $validStatuses, true);
        $this->response
            ->expects($isValidStatus ? $this->never() : $this->once())
            ->method('getBody')
            ->willReturn($body);

        $result = ResponseHelper::extractException(
            $this->response,
            $validStatuses
        );
        if ($expected !== null) {
            $this->assertNotNull($result);
            $this->assertEquals($expected['message'], $result->getMessage());
            $this->assertEquals($this->response, $result->getResponse());
            $this->assertEquals($expected['code'], $result->getCode());

            if ($result instanceof Exception\DataValidateException) {
                $this->assertEquals(
                    $expected['invalidParams'],
                    $result->getInvalidParams()
                );
            }
        } else {
            $this->assertNull($result);
        }
    }

    /**
     * @covers       \CallbackHunterAPIv2\Helper\ResponseHelper::getBodyAsArray
     *
     * @dataProvider getBodyAsArrayProvider
     *
     * @param $string
     * @param $expected
     */
    public function testGetBodyAsArray($string, $expected)
    {
        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($string);

        $this->assertEquals(
            $expected,
            ResponseHelper::getBodyAsArray($this->response)
        );
    }

    public function getBodyAsArrayProvider()
    {
        return [
            ['{"foo":"bar"}', ['foo' => 'bar']],
            ['test', []],
        ];
    }

    public function extractExceptionProvider()
    {
        return [
            [200, '{"foo": "bar"}', null],
            [201, '{"foo": "bar"}', null],
            [
                400,
                '{"title": "bar", "invalidParams": [{"foo":"baz"}]}',
                [
                    'message'       => 'bar',
                    'code'          => 400,
                    'invalidParams' => [['foo' => 'baz']],
                ],
            ],
            [
                402,
                '{"title": "bar", "invalidParams": [{"foo":"baz"}]}',
                [
                    'message'       => 'bar',
                    'code'          => 402,
                    'invalidParams' => [['foo' => 'baz']],
                ],
            ],
            [
                403,
                '{"title": "bar", "invalidParams": [{"foo":"baz"}]}',
                [
                    'message'       => 'bar',
                    'code'          => 403,
                    'invalidParams' => [['foo' => 'baz']],
                ],
            ],
            [
                404,
                '{"title": "bar"}',
                [
                    'message'       => 'bar',
                    'code'          => 404,
                    'invalidParams' => null,
                ],
            ],
            [
                500,
                '{"title": "bar"}',
                [
                    'message'       => 'bar',
                    'code'          => 500,
                    'invalidParams' => null,
                ],
            ],
        ];
    }

    protected function setUp()
    {
        parent::setUp();
        $this->response = $this->createMock(ResponseInterface::class);
    }
}
