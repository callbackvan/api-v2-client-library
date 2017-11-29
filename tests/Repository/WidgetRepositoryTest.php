<?php

namespace Tets\Repository;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use Psr\Http\Message\ResponseInterface;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use CallbackHunterAPIv2\ValueObject\Pagination;

/**
 * Class WidgetRepositoryTest
 * @package Tets\Repository
 * @covers \CallbackHunterAPIv2\Repository\WidgetRepository
 */
class WidgetRepositoryTest extends TestCase
{
    /** @var ClientInterface  */
    private $client;

    /** @var WidgetInterface  */
    private $widget;

    /** @var WidgetFactoryInterface  */
    private $widgetFactory;

    /** @var ResponseInterface  */
    private $response;

    /** @var string  */
    private $path = 'widgets';

    /** @var array  */
    private $defaultWidgetToApi = [
        'isActive' => true,
        'site' => 'example.com',
        'settings' => [
            'colors' => [
                'iconBackground' => '00aff2',
                'backgroundSlider' => '00aff2',
            ],
            'position' => [
                'x' => 90,
                'y' => 100,
            ],
            'images' => [
                'buttonLogo' => '',
                'iconLogoSlider' => '',
                'backgroundSlider' => '',
            ],
            'channels' => [
                'callback' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'sms' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'builtIn' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'telegram' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'vk' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'facebook' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'viber' => [
                    'isMobileEnabled' => true,
                ],
                'skype' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
            ],
        ],
    ];

    /** @var array  */
    private $defaultSaveResponseBody = [
        '_links' => [
            'self' => [
                'href' => '/widgets/123f6bcd4621d373cade4e832627b4f6',
            ],
            'list' => [
                'href' => '/widgets',
            ],
        ],
        'uid' => '123f6bcd4621d373cade4e832627b4f6',
        'version' => 7,
        'isActive' => true,
        'site' => 'example.com',
        'code' => 'd9729xcv74992cc3482b350163a1a010',
        'settings' => [
            'colors' => [
                'iconBackground' => '00aff2',
                'backgroundSlider' => '00aff2',
            ],
            'position' => [
                'x' => 90,
                'y' => 100,
            ],
            'images' => [
                'buttonLogo' => '',
                'iconLogoSlider' => '',
                'backgroundSlider' => '',
            ],
            'channels' => [
                'callback' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'sms' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'builtIn' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'telegram' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'vk' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'facebook' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
                'viber' => [
                    'isMobileEnabled' => true,
                ],
                'skype' => [
                    'isDesktopEnabled' => true,
                    'isMobileEnabled' => true,
                ],
            ],
        ],
    ];

    /** @var array  */
    private $defaultGetListResponseBody = [
        '_links' =>[
            'self' =>[
                'href' => '/widgets?limit=10&offset=0',
            ],
            'next' =>[
                'href' => '/widgets??limit=10&offset=10',
            ],
            'find' =>[
                'href' => '/widgets{?uid}',
                'templated' => true,
            ],
        ],
        '_embedded' => [
            'widgets' => [
                [
                    '_links' => [
                        'self' => [
                            'href' => '/widgets/123f6bcd4621d373cade4e832627b4f6',
                        ],
                    ],
                    'uid' => '123f6bcd4621d373cade4e832627b4f6',
                    'version' => 7,
                    'isActive' => true,
                    'site' => 'example.com',
                    'code' => 'd9729xcv74992cc3482b350163a1a010',
                    'settings' => [
                        'colors' => [
                            'iconBackground' => '00aff2',
                            'backgroundSlider' => '00aff2',
                        ],
                        'position' => [
                            'x' => 90,
                            'y' => 100,
                        ],
                        'images' => [
                            'buttonLogo' => '',
                            'iconLogoSlider' => '',
                            'backgroundSlider' => '',
                        ],
                        'channels' => [
                            'callback' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'sms' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'builtIn' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'telegram' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'vk' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'facebook' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'viber' => [
                                'isMobileEnabled' => true,
                            ],
                            'skype' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                        ],
                    ],
                ],
                [
                    '_links' => [
                        'self' => [
                            'href' => '/widgets/456f6bcd4621d373cade4e832627b4f6',
                        ],
                    ],
                    'uid' => '456f6bcd4621d373cade4e832627b4f6',
                    'version' => 7,
                    'isActive' => true,
                    'site' => 'example.com',
                    'code' => '96325feb74992cc3482b350163a1a010',
                    'settings' => [
                        'colors' => [
                            'iconBackground' => '00aff2',
                            'backgroundSlider' => '00aff2',
                        ],
                        'position' => [
                            'x' => 90,
                            'y' => 100,
                        ],
                        'images' => [
                            'buttonLogo' => '',
                            'iconLogoSlider' => '',
                            'backgroundSlider' => '',
                        ],
                        'channels' => [
                            'callback' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'sms' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'builtIn' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'telegram' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'vk' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'facebook' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                            'viber' => [
                                'isMobileEnabled' => true,
                            ],
                            'skype' => [
                                'isDesktopEnabled' => true,
                                'isMobileEnabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'pagination' =>[
            'limit' => 10,
            'offset' => 0,
            'total' => 2,
        ],
    ];

    /** @var array  */
    private $defaultQuery = [
        'limit' => Pagination::DEFAULT_LIMIT,
        'offset' => Pagination::DEFAULT_OFFSET,
    ];

    public function testSave()
    {
        $this->widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToApi)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($this->defaultSaveResponseBody));

        $expectedWidget = $this->createMock(WidgetInterface::class);

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultSaveResponseBody)
            ->willReturn($expectedWidget);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($expectedWidget, $widgetRepository->save($this->widget));
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\WidgetValidateException
     */
    public function testSaveThrowWidgetValidateException()
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

        $this->widget->expects($this->once())
            ->method('toApi')
            ->willReturn($dataToApi);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $dataToApi)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $widgetRepository->save($this->widget);
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException
     */
    public function testSaveThrowChangeOfPaidPropertiesException()
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

        $this->widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToApi)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $widgetRepository->save($this->widget);
    }

    /**
     * @expectedException \CallbackHunterAPIv2\Exception\Exception
     */
    public function testSaveThrowException()
    {
        $errorResponseBody = [
            'status' => 404,
        ];

        $this->widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToApi)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $widgetRepository->save($this->widget);
    }

    public function testGetList()
    {
        $responseData = $this->defaultGetListResponseBody;
        $widgets = (array)$responseData['_embedded']['widgets'];

        $pagination = $this->createMock(PaginationInterface::class);
        $pagination->expects($this->once())
            ->method('getLimit')
            ->willReturn(Pagination::DEFAULT_LIMIT);
        $pagination->expects($this->once())
            ->method('getOffset')
            ->willReturn(Pagination::DEFAULT_OFFSET);

        $this->client->expects($this->once())
            ->method('requestGet')
            ->with($this->path, $this->defaultQuery)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($this->defaultGetListResponseBody));

        $this->widgetFactory->expects($this->at(0))
            ->method('fromAPI')
            ->with($widgets[0])
            ->willReturn($this->widget);
        $this->widgetFactory->expects($this->at(1))
            ->method('fromAPI')
            ->with($widgets[1])
            ->willReturn($this->widget);

        $expected = [$this->widget, $this->widget];

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($expected, $widgetRepository->getList($pagination));
    }

    public function testGetListReturnedEmptyResults()
    {
        $pagination = $this->createMock(PaginationInterface::class);
        $pagination->expects($this->once())
            ->method('getLimit')
            ->willReturn(Pagination::DEFAULT_LIMIT);
        $pagination->expects($this->once())
            ->method('getOffset')
            ->willReturn(Pagination::DEFAULT_OFFSET);

        $this->client->expects($this->once())
            ->method('requestGet')
            ->with($this->path, $this->defaultQuery)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(204);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn('{}');

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame([], $widgetRepository->getList($pagination));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->createMock(ClientInterface::class);
        $this->widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->widget = $this->createMock(WidgetInterface::class);
    }
}
