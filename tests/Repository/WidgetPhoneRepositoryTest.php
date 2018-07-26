<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Helper\ResponseHelper;
use CallbackHunterAPIv2\Repository\WidgetPhoneRepository;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Class WidgetPhoneRepositoryTest
 *
 * @package CallbackHunterAPIv2\Tests\Repository
 */
class WidgetPhoneRepositoryTest extends TestCase
{
    /**
     * @var WidgetPhoneRepository
     */
    private $widgetPhoneRepository;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ResponseHelper
     */
    private $responseHelper;

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::updatePhone
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpdatePhone()
    {
        $uid = md5('test');
        $phone = '911';

        $responseData = [
            'foo' => 'bar',
        ];

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $uid . '/phone/update',
                ['phone' => $phone]
            )
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($responseData));

        $this->assertEquals($responseData, $this->widgetPhoneRepository->updatePhone($uid, $phone));
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::updatePhone
     *
     * @expectedException \CallbackHunterAPIv2\Exception\DataValidateException
     *
     * @expectedExceptionMessage Переданы неверные настройки виджета
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpdatePhoneThrowsWidgetPhoneValidateException()
    {
        $uid = md5('test');
        $phone = '911';
        $path = '/widgets/' . $uid . '/phone/update';

        $errorResponseBody = [
            'type'          => 'https://developers.callbackhunter.com/#errorWidgetValidation',
            'title'         => 'Переданы неверные настройки виджета',
            'status'        => 400,
            'detail'        => 'Один или несколько параметров виджета '.
                'были переданы в неверном формате. Обратите внимание,'.
                ' что список доступных параметров с указанием ограничений '.
                'по ним можно увидеть в документации по адресу '.
                'https://developers.callbackhunter.com/#WidgetNotSaved',
            'invalidParams' => [
                [
                    'name'   => 'site',
                    'reason' => 'Поле "сайт" не может быть пустым.',
                ],
            ],
        ];

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with($path, ['phone' => $phone])
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(400);

        $this->widgetPhoneRepository->updatePhone($uid, $phone);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::updatePhone
     *
     * @expectedException \CallbackHunterAPIv2\Exception\RepositoryException
     *
     * @expectedExceptionMessage Content is not json
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpdatePhoneThrowsRepositoryException()
    {
        $uid = md5('test');
        $phone = '911';

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $uid . '/phone/update',
                ['phone' => $phone]
            )
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('not json');

        $this->widgetPhoneRepository->updatePhone($uid, $phone);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->response = $this->createMock(ResponseInterface::class);
        $this->responseHelper = $this->createMock(ResponseHelper::class);

        $this->widgetPhoneRepository = new WidgetPhoneRepository(
            $this->client = $this->createMock(ClientInterface::class)
        );
    }
}
