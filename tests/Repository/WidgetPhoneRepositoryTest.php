<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Phone\PhoneInterface;
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
     * @covers       \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers       \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::save
     *
     * @dataProvider saveDataProvider
     *
     * @param $phoneUID
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSave($phoneUID)
    {
        $phoneId = 1234;
        $phoneNumber = '8(800)200-02-02';
        $uid = md5('test');

        $pathForUpdate = '/widgets/' . $uid . '/phones/' . $phoneId;
        $pathForAdd = '/widgets/' . $uid . '/phones';
        $phone = $this->createMock(PhoneInterface::class);

        $responseData = [
            'foo' => 'bar',
        ];

        $phone
            ->expects($phoneUID ? $this->exactly(2) : $this->once())
            ->method('getId')
            ->willReturn($phoneUID ? $phoneId : null);

        $phone
            ->expects($this->once())
            ->method('getPhone')
            ->willReturn($phoneNumber);

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                $phoneUID ? $pathForUpdate : $pathForAdd,
                [
                    'phone' => $phoneNumber
                ]
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

        $this->assertEquals($responseData, $this->widgetPhoneRepository->save($uid, $phone));
    }

    public function saveDataProvider()
    {
        return [[true], [false]];
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::save
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
        $phone = $this->createMock(PhoneInterface::class);
        $path = '/widgets/' . $uid . '/phones';
        $phoneNumber= ' 891';

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

        $phone
            ->expects($this->once())
            ->method('getPhone')
            ->willReturn($phoneNumber);

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with($path, ['phone' => $phoneNumber])
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(400);

        $this->widgetPhoneRepository->save($uid, $phone);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\WidgetPhoneRepository::save
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
        $phoneNumber = '911';

        $phone = $this->createMock(PhoneInterface::class);
        $phone
            ->expects($this->once())
            ->method('getPhone')
            ->willReturn($phoneNumber);

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                '/widgets/' . $uid . '/phones',
                ['phone' => $phoneNumber]
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

        $this->widgetPhoneRepository->save($uid, $phone);
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
