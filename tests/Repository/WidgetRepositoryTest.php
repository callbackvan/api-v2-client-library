<?php

namespace Tets\Repository;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use Psr\Http\Message\ResponseInterface;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;

/**
 * Class WidgetRepositoryTest
 * @package Tets\Repository
 * @covers \CallbackHunterAPIv2\Repository\WidgetRepository
 */
class WidgetRepositoryTest extends TestCase
{
    private $path = 'widgets';

    private $defaultWidgetToApi = array (
        'isActive' => true,
        'site' => 'example.com',
        'settings' =>
            array (
                'colors' =>
                    array (
                        'iconBackground' => '00aff2',
                        'backgroundSlider' => '00aff2',
                    ),
                'position' =>
                    array (
                        'x' => 90,
                        'y' => 100,
                    ),
                'images' =>
                    array (
                        'buttonLogo' => '',
                        'iconLogoSlider' => '',
                        'backgroundSlider' => '',
                    ),
                'channels' =>
                    array (
                        'callback' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'sms' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'builtIn' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'telegram' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'vk' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'facebook' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'viber' =>
                            array (
                                'isMobileEnabled' => true,
                            ),
                        'skype' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                    ),
            ),
    );

    private $defaultResponseBody = array (
        '_links' =>
            array (
                'self' =>
                    array (
                        'href' => '/widgets/123f6bcd4621d373cade4e832627b4f6',
                    ),
                'list' =>
                    array (
                        'href' => '/widgets',
                    ),
            ),
        'uid' => '123f6bcd4621d373cade4e832627b4f6',
        'version' => 7,
        'isActive' => true,
        'site' => 'example.com',
        'code' => 'd9729xcv74992cc3482b350163a1a010',
        'settings' =>
            array (
                'colors' =>
                    array (
                        'iconBackground' => '00aff2',
                        'backgroundSlider' => '00aff2',
                    ),
                'position' =>
                    array (
                        'x' => 90,
                        'y' => 100,
                    ),
                'images' =>
                    array (
                        'buttonLogo' => '',
                        'iconLogoSlider' => '',
                        'backgroundSlider' => '',
                    ),
                'channels' =>
                    array (
                        'callback' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'sms' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'builtIn' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'telegram' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'vk' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'facebook' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                        'viber' =>
                            array (
                                'isMobileEnabled' => true,
                            ),
                        'skype' =>
                            array (
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ),
                    ),
            ),
    );

    public function testSave()
    {
        $widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $widget = $this->createMock(WidgetInterface::class);
        $widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToApi)
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);
        $response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($this->defaultResponseBody));

        $expectedWidget = $this->createMock(WidgetInterface::class);

        $widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultResponseBody)
            ->willReturn($expectedWidget);

        $widgetRepository = new WidgetRepository($client, $widgetFactory);

        $this->assertSame($expectedWidget, $widgetRepository->save($widget));
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\WidgetValidateException
     */
    public function testSendThrowWidgetValidateException()
    {
        $dataToApi = $this->defaultWidgetToApi;
        $dataToApi['site'] = '';
        $errorResponseBody = [
            'type' => 'https://developers.callbackhunter.com/#errorWidgetValidation',
            'title' => 'Переданы неверные настройки виджета',
            'status' => 400,
            'detail' => 'Один или несколько параметров виджета были переданы в неверном формате. Обратите внимание, что список доступных параметров с указанием ограничений по ним можно увидеть в документации по адресу https://developers.callbackhunter.com/#WidgetNotSaved',
            'invalidParams' =>[
                [
                    'name' => 'site',
                    'reason' => 'Поле "сайт" не может быть пустым.',
                ],
            ],
        ];

        $widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $widget = $this->createMock(WidgetInterface::class);
        $widget->expects($this->once())
            ->method('toApi')
            ->willReturn($dataToApi);

        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $dataToApi)
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $widgetRepository = new WidgetRepository($client, $widgetFactory);

        $widgetRepository->save($widget);
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException
     */
    public function testSendThrowChangeOfPaidPropertiesException()
    {
        $errorResponseBody = [
            'type' => 'https://developers.callbackhunter.com/#errorChangingOfPaidProperties',
            'title' => 'Попытка изменить платные настройки',
            'status' => 402,
            'detail' => 'Для изменения переданных параметров необходимо оплатить аккаунт. Обратите внимание, что список доступных параметров с указанием ограничений по ним можно увидеть в документации по адресу https://developers.callbackhunter.com/#WidgetNotSaved',
            'invalidParams' => [
                [
                    'name' => 'settings.colors.iconBackground',
                    'reason' => 'Для изменения цвета кнопки необходимо оплатить аккаунт.',
                ],
            ],
        ];

        $widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $widget = $this->createMock(WidgetInterface::class);
        $widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToApi)
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $widgetRepository = new WidgetRepository($client, $widgetFactory);

        $widgetRepository->save($widget);
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\Exception
     */
    public function testSendThrowException()
    {
        $errorResponseBody = [
            'status' => 404,
        ];

        $widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $widget = $this->createMock(WidgetInterface::class);
        $widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToApi)
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);

        $widgetRepository = new WidgetRepository($client, $widgetFactory);

        $widgetRepository->save($widget);
    }
}
