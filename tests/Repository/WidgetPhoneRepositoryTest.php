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
        $widgetUID= md5('test');
        $phoneUID = md5('test1');
        $phone = '911';

        $responseData = [
            'foo' => 'bar',
        ];

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $widgetUID . '/phones/' . $phoneUID,
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

        $this->assertEquals($responseData, $this->widgetPhoneRepository->updatePhone($widgetUID, $phoneUID, $phone));
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
        $widgetUID= md5('test');
        $phoneUID = md5('test1');
        $phone = '911';
        $path = '/widgets/' . $widgetUID . '/phones/' . $phoneUID;

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

        $this->widgetPhoneRepository->updatePhone($widgetUID, $phoneUID, $phone);
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
        $widgetUID= md5('test');
        $phoneUID = md5('test1');
        $phone = '911';

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $widgetUID . '/phones/' . $phoneUID,
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

        $this->widgetPhoneRepository->updatePhone($widgetUID, $phoneUID, $phone);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::addPhone
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAddPhone()
    {
        $widgetUID= md5('test');
        $phone = '911';

        $responseData = [
            'foo' => 'bar',
        ];

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $widgetUID . '/phones',
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

        $this->assertEquals($responseData, $this->widgetPhoneRepository->addPhone($widgetUID, $phone));
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::addPhone
     *
     * @expectedException \CallbackHunterAPIv2\Exception\DataValidateException
     *
     * @expectedExceptionMessage Переданы неверные настройки виджета
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAddPhoneThrowsWidgetPhoneValidateException()
    {
        $widgetUID= md5('test');
        $phone = '911';
        $path = '/widgets/' . $widgetUID . '/phones';

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

        $this->widgetPhoneRepository->addPhone($widgetUID, $phone);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::addPhone
     *
     * @expectedException \CallbackHunterAPIv2\Exception\RepositoryException
     *
     * @expectedExceptionMessage Content is not json
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAddPhoneThrowsRepositoryException()
    {
        $widgetUID= md5('test');
        $phone = '911';

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $widgetUID . '/phones',
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

        $this->widgetPhoneRepository->addPhone($widgetUID, $phone);
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
