<?php

namespace Tests\Repository;

use PHPUnit\Framework\TestCase;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use Psr\Http\Message\ResponseInterface;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use CallbackHunterAPIv2\ValueObject\Pagination;
use CallbackHunterAPIv2\Entity\Widget\Settings\SettingsInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\ImagesInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage;
use CallbackHunterAPIv2\Type\FileForUploadInterface;

/**
 * Class WidgetRepositoryTest
 * @package Tests\Repository
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

        $resultWidget = $this->createMock(WidgetInterface::class);

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultSaveResponseBody)
            ->willReturn($resultWidget);

        $settings = $this->createMock(SettingsInterface::class);

        $this->widget->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $images = $this->createMock(ImagesInterface::class);

        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $buttonLogo = $this->createMock(AbstractImage::class);
        $buttonLogo->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $iconLogoSlider = $this->createMock(AbstractImage::class);
        $iconLogoSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $backgroundSlider = $this->createMock(AbstractImage::class);
        $backgroundSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $images->expects($this->once())
            ->method('getButtonLogo')
            ->willReturn($buttonLogo);
        $images->expects($this->once())
            ->method('getIconLogoSlider')
            ->willReturn($iconLogoSlider);
        $images->expects($this->once())
            ->method('getBackgroundSlider')
            ->willReturn($backgroundSlider);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($resultWidget, $widgetRepository->save($this->widget));
    }

    public function testSaveWithUid()
    {
        $uid = '123f6bcd4621d373cade4e832627b4f6';
        $widget = $this->widget;
        $widget->expects($this->any())
            ->method('getUid')
            ->willReturn($uid);

        $toApi = $this->defaultWidgetToApi;
        $toApi['uid'] = $uid;

        $this->widget->expects($this->once())
            ->method('toApi')
            ->willReturn($this->defaultWidgetToApi);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path . '/' . $uid, $this->defaultWidgetToApi)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($this->defaultSaveResponseBody));

        $resultWidget = $this->createMock(WidgetInterface::class);

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultSaveResponseBody)
            ->willReturn($resultWidget);

        $settings = $this->createMock(SettingsInterface::class);

        $this->widget->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $images = $this->createMock(ImagesInterface::class);

        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $buttonLogo = $this->createMock(AbstractImage::class);
        $buttonLogo->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $iconLogoSlider = $this->createMock(AbstractImage::class);
        $iconLogoSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $backgroundSlider = $this->createMock(AbstractImage::class);
        $backgroundSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $images->expects($this->once())
            ->method('getButtonLogo')
            ->willReturn($buttonLogo);
        $images->expects($this->once())
            ->method('getIconLogoSlider')
            ->willReturn($iconLogoSlider);
        $images->expects($this->once())
            ->method('getBackgroundSlider')
            ->willReturn($backgroundSlider);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($resultWidget, $widgetRepository->save($widget));
    }

    public function testSaveWithSetButtonLogo()
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

        $resultWidget = $this->createMock(WidgetInterface::class);

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultSaveResponseBody)
            ->willReturn($resultWidget);

        $settings = $this->createMock(SettingsInterface::class);

        $this->widget->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $images = $this->createMock(ImagesInterface::class);

        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $file = $this->createMock(FileForUploadInterface::class);

        $buttonLogo = $this->createMock(AbstractImage::class);
        $buttonLogo->expects($this->any())
            ->method('getForUpload')
            ->willReturn($file);

        $iconLogoSlider = $this->createMock(AbstractImage::class);
        $iconLogoSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $backgroundSlider = $this->createMock(AbstractImage::class);
        $backgroundSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $images->expects($this->once())
            ->method('getButtonLogo')
            ->willReturn($buttonLogo);
        $images->expects($this->once())
            ->method('getIconLogoSlider')
            ->willReturn($iconLogoSlider);
        $images->expects($this->once())
            ->method('getBackgroundSlider')
            ->willReturn($backgroundSlider);

        $responseUploadImage = $this->createMock(ResponseInterface::class);

        $resultWidget->expects($this->once())
            ->method('getUid')
            ->willReturn($this->defaultSaveResponseBody['uid']);

        $path = sprintf('/widgets/%s/settings/images/buttonLogo', $this->defaultSaveResponseBody['uid']);
        $responseBody = [
            '_links' => [
                'self' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6/settings/images/displayName',
                ],
                'widget' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                ],
            ],
            'name' => 'displayName',
            'value' => 'some.png',
            'url' => 'https://callbackhunter.com/uploads/some.png',
        ];

        $this->client->expects($this->once())
            ->method('uploadFile')
            ->with($path, $buttonLogo->getForUpload())
            ->willReturn($responseUploadImage);

        $responseUploadImage->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);
        $responseUploadImage->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($responseBody));

        $resultSettings = $this->createMock(SettingsInterface::class);
        $resultWidget->expects($this->once())
            ->method('getSettings')
            ->willReturn($resultSettings);

        $resultImages = $this->createMock(ImagesInterface::class);

        $resultSettings->expects($this->once())
            ->method('getImages')
            ->willReturn($resultImages);

        $resultButtonLogo = $this->createMock(AbstractImage::class);

        $resultImages->expects($this->once())
            ->method('getButtonLogo')
            ->willReturn($resultButtonLogo);

        $resultButtonLogo->expects($this->once())
            ->method('setName')
            ->with($responseBody['value']);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($resultWidget, $widgetRepository->save($this->widget));
    }

    public function testSaveWithSetIconLogoSlider()
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

        $resultWidget = $this->createMock(WidgetInterface::class);

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultSaveResponseBody)
            ->willReturn($resultWidget);

        $settings = $this->createMock(SettingsInterface::class);

        $this->widget->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $images = $this->createMock(ImagesInterface::class);

        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $file = $this->createMock(FileForUploadInterface::class);

        $buttonLogo = $this->createMock(AbstractImage::class);
        $buttonLogo->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $iconLogoSlider = $this->createMock(AbstractImage::class);
        $iconLogoSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn($file);

        $backgroundSlider = $this->createMock(AbstractImage::class);
        $backgroundSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $images->expects($this->once())
            ->method('getButtonLogo')
            ->willReturn($buttonLogo);
        $images->expects($this->once())
            ->method('getIconLogoSlider')
            ->willReturn($iconLogoSlider);
        $images->expects($this->once())
            ->method('getBackgroundSlider')
            ->willReturn($backgroundSlider);

        $responseUploadImage = $this->createMock(ResponseInterface::class);

        $resultWidget->expects($this->once())
            ->method('getUid')
            ->willReturn($this->defaultSaveResponseBody['uid']);

        $path = sprintf('/widgets/%s/settings/images/iconLogoSlider', $this->defaultSaveResponseBody['uid']);
        $responseBody = [
            '_links' => [
                'self' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6/settings/images/iconLogoSlider',
                ],
                'widget' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                ],
            ],
            'name' => 'iconLogoSlider',
            'value' => 'some.png',
            'url' => 'https://callbackhunter.com/uploads/some.png',
        ];

        $this->client->expects($this->once())
            ->method('uploadFile')
            ->with($path, $iconLogoSlider->getForUpload())
            ->willReturn($responseUploadImage);

        $responseUploadImage->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);
        $responseUploadImage->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($responseBody));

        $resultSettings = $this->createMock(SettingsInterface::class);
        $resultWidget->expects($this->once())
            ->method('getSettings')
            ->willReturn($resultSettings);

        $resultImages = $this->createMock(ImagesInterface::class);

        $resultSettings->expects($this->once())
            ->method('getImages')
            ->willReturn($resultImages);

        $resultIconLogoSlider = $this->createMock(AbstractImage::class);

        $resultImages->expects($this->once())
            ->method('getIconLogoSlider')
            ->willReturn($resultIconLogoSlider);

        $resultIconLogoSlider->expects($this->once())
            ->method('setName')
            ->with($responseBody['value']);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($resultWidget, $widgetRepository->save($this->widget));
    }

    public function testSaveWithSetBackgroundSlider()
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

        $resultWidget = $this->createMock(WidgetInterface::class);

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($this->defaultSaveResponseBody)
            ->willReturn($resultWidget);

        $settings = $this->createMock(SettingsInterface::class);

        $this->widget->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $images = $this->createMock(ImagesInterface::class);

        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $file = $this->createMock(FileForUploadInterface::class);

        $buttonLogo = $this->createMock(AbstractImage::class);
        $buttonLogo->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $iconLogoSlider = $this->createMock(AbstractImage::class);
        $iconLogoSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn(null);

        $backgroundSlider = $this->createMock(AbstractImage::class);
        $backgroundSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn($file);

        $images->expects($this->once())
            ->method('getButtonLogo')
            ->willReturn($buttonLogo);
        $images->expects($this->once())
            ->method('getIconLogoSlider')
            ->willReturn($iconLogoSlider);
        $images->expects($this->once())
            ->method('getBackgroundSlider')
            ->willReturn($backgroundSlider);

        $responseUploadImage = $this->createMock(ResponseInterface::class);

        $resultWidget->expects($this->once())
            ->method('getUid')
            ->willReturn($this->defaultSaveResponseBody['uid']);

        $path = sprintf('/widgets/%s/settings/images/backgroundSlider', $this->defaultSaveResponseBody['uid']);
        $responseBody = [
            '_links' => [
                'self' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6/settings/images/backgroundSlider',
                ],
                'widget' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                ],
            ],
            'name' => 'backgroundSlider',
            'value' => 'some.png',
            'url' => 'https://callbackhunter.com/uploads/some.png',
        ];

        $this->client->expects($this->once())
            ->method('uploadFile')
            ->with($path, $backgroundSlider->getForUpload())
            ->willReturn($responseUploadImage);

        $responseUploadImage->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);
        $responseUploadImage->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($responseBody));

        $resultSettings = $this->createMock(SettingsInterface::class);
        $resultWidget->expects($this->once())
            ->method('getSettings')
            ->willReturn($resultSettings);

        $resultImages = $this->createMock(ImagesInterface::class);

        $resultSettings->expects($this->once())
            ->method('getImages')
            ->willReturn($resultImages);

        $resultBackgroundSlider = $this->createMock(AbstractImage::class);

        $resultImages->expects($this->once())
            ->method('getBackgroundSlider')
            ->willReturn($resultBackgroundSlider);

        $resultBackgroundSlider->expects($this->once())
            ->method('setName')
            ->with($responseBody['value']);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($resultWidget, $widgetRepository->save($this->widget));
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
     * @expectedException \CallbackHunterAPIv2\Exception\ResourceNotFoundException
     */
    public function testSaveThrowResourceNotFoundException()
    {
        $errorResponseBody = [
            'type' => 'https://developers.callbackhunter.com/#error404',
            'title' => 'Заправшиваемый ресурс не найден',
            'status' => 404,
            'detail' => 'Обратите внимание, что список доступных ресурсов можно увидеть в документации по адресу https://developers.callbackhunter.com/',
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
            'status' => 500,
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

    public function testGet()
    {
        $uid = '123f6bcd4621d373cade4e832627b4f6';
        $responseBody = [
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

        $this->client->expects($this->once())
            ->method('requestGet')
            ->with($this->path . '/' . $uid)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($responseBody));

        $this->widgetFactory->expects($this->once())
            ->method('fromAPI')
            ->with($responseBody)
            ->willReturn($this->widget);

        $widgetRepository = new WidgetRepository($this->client, $this->widgetFactory);

        $this->assertSame($this->widget, $widgetRepository->get($uid));
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
