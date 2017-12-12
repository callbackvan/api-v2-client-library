<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use CallbackHunterAPIv2\Entity\Widget\Settings\SettingsInterface;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\Repository\WidgetRepository;
use CallbackHunterAPIv2\Type\FileForUploadInterface;
use CallbackHunterAPIv2\ValueObject\Pagination;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Class WidgetRepositoryTest
 *
 * @package Tests\Repository
 * @covers  \CallbackHunterAPIv2\Repository\WidgetRepository
 */
class WidgetRepositoryTest extends TestCase
{
    /** @var ClientInterface */
    private $client;

    /** @var WidgetInterface */
    private $widget;

    /** @var WidgetFactoryInterface */
    private $widgetFactory;

    /** @var WidgetRepository */
    private $widgetRepository;

    /** @var ResponseInterface */
    private $response;

    /** @var string */
    private $path = 'widgets';

    /** @var array */
    private $defaultWidgetToAPI = ['foo' => 'bar'];

    /** @var array */
    private $defaultSaveResponseBody = ['bar' => 'foo'];

    /** @var array */
    private $defaultQuery
        = [
            'limit'  => Pagination::DEFAULT_LIMIT,
            'offset' => Pagination::DEFAULT_OFFSET,
        ];

    /**
     * @param string $uid
     *
     * @covers       \CallbackHunterAPIv2\Repository\WidgetRepository::save
     * @dataProvider widgetUidProvider
     */
    public function testSave($uid)
    {
        $data = $widgetToAPI = $this->defaultWidgetToAPI;

        if ($uid !== null) {
            $this->path .= '/';
            $widgetToAPI['uid'] = $uid;
        }

        $widget = $this->widget;
        $widget->expects($this->any())
            ->method('getUid')
            ->willReturn($uid);

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($widgetToAPI);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path.$uid, $data)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($uid !== null ? 200 : 201);
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

        $images = $this->createMock(Images::class);

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

        $this->assertSame(
            $resultWidget,
            $this->widgetRepository->save($widget)
        );
    }

    public function widgetUidProvider()
    {
        return [
            ['123f6bcd4621d373cade4e832627b4f6'],
            [null],
        ];
    }

    /**
     * @param $uid
     * @param $pathPart
     * @param $files
     * @param $responseBody
     * @param $method
     *
     * @covers       \CallbackHunterAPIv2\Repository\WidgetRepository::save
     * @dataProvider widgetDataProvider
     */
    public function testSaveWithSetImage(
        $uid,
        $pathPart,
        $files,
        $responseBody,
        $method
    ) {
        $widgetToAPI = $this->defaultWidgetToAPI;

        if ($uid !== null) {
            $widgetToAPI['uid'] = $uid;
        }

        $responseBody['value'] = 'some.png';

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($widgetToAPI);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $widgetToAPI)
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

        $images = $this->createMock(Images::class);

        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $buttonLogo = $this->createMock(AbstractImage::class);
        $buttonLogo->expects($this->any())
            ->method('getForUpload')
            ->willReturn($files[0]);

        $iconLogoSlider = $this->createMock(AbstractImage::class);
        $iconLogoSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn($files[1]);

        $backgroundSlider = $this->createMock(AbstractImage::class);
        $backgroundSlider->expects($this->any())
            ->method('getForUpload')
            ->willReturn($files[2]);

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
            ->willReturn($uid);

        $format = '/widgets/%s/settings/images/'.$pathPart;
        $path = sprintf($format, $uid);

        if ($pathPart === 'buttonLogo') {
            $this->client->expects($this->once())
                ->method('uploadFile')
                ->with($path, $buttonLogo->getForUpload())
                ->willReturn($responseUploadImage);
        }

        if ($pathPart === 'iconLogoSlider') {
            $this->client->expects($this->once())
                ->method('uploadFile')
                ->with($path, $iconLogoSlider->getForUpload())
                ->willReturn($responseUploadImage);
        }

        if ($pathPart === 'backgroundSlider') {
            $this->client->expects($this->once())
                ->method('uploadFile')
                ->with($path, $backgroundSlider->getForUpload())
                ->willReturn($responseUploadImage);
        }

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

        $resultImages = $this->createMock(Images::class);

        $resultSettings->expects($this->once())
            ->method('getImages')
            ->willReturn($resultImages);

        $resultLogo = $this->createMock(AbstractImage::class);

        $resultImages->expects($this->once())
            ->method($method)
            ->willReturn($resultLogo);

        $resultLogo->expects($this->once())
            ->method('setName')
            ->with($responseBody['value']);

        $this->assertSame(
            $resultWidget,
            $this->widgetRepository->save($this->widget)
        );
    }

    public function widgetDataProvider()
    {
        $file = $this->createMock(FileForUploadInterface::class);

        return [
            [
                '123f6bcd4621d373cade4e832627b4f6',
                'buttonLogo',
                [$file, null, null],
                ['name' => 'displayName'],
                'getButtonLogo',
            ],
            [
                null,
                'buttonLogo',
                [$file, null, null],
                ['name' => 'displayName'],
                'getButtonLogo',
            ],
            [
                '123f6bcd4621d373cade4e832627b4f6',
                'iconLogoSlider',
                [null, $file, null],
                ['name' => 'iconLogoSlider'],
                'getIconLogoSlider',
            ],
            [
                null,
                'iconLogoSlider',
                [null, $file, null],
                ['name' => 'iconLogoSlider'],
                'getIconLogoSlider',
            ],
            [
                '123f6bcd4621d373cade4e832627b4f6',
                'backgroundSlider',
                [null, null, $file],
                ['name' => 'backgroundSlider'],
                'getBackgroundSlider',
            ],
            [
                null,
                'backgroundSlider',
                [null, null, $file],
                ['name' => 'backgroundSlider'],
                'getBackgroundSlider',
            ],
        ];
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::save
     * @expectedException \CallbackHunterAPIv2\Exception\WidgetValidateException
     */
    public function testSaveThrowWidgetValidateException()
    {
        $dataToAPI = $this->defaultWidgetToAPI;
        $dataToAPI['site'] = '';
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

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($dataToAPI);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $dataToAPI)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->widgetRepository->save($this->widget);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::save
     * @expectedException \CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException
     */
    public function testSaveThrowChangeOfPaidPropertiesException()
    {
        $errorResponseBody = [
            'type'          => 'https://developers.callbackhunter.com/#errorChangingOfPaidProperties',
            'title'         => 'Попытка изменить платные настройки',
            'status'        => 402,
            'detail'        => 'Для изменения переданных параметров необходимо '
                .
                'оплатить аккаунт. Обратите внимание, что список доступных '.
                'параметров с указанием ограничений по ним можно увидеть в '.
                'документации по адресу '.
                'https://developers.callbackhunter.com/#WidgetNotSaved',
            'invalidParams' => [
                [
                    'name'   => 'settings.colors.iconBackground',
                    'reason' => 'Для изменения цвета кнопки необходимо оплатить аккаунт.',
                ],
            ],
        ];

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($this->defaultWidgetToAPI);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToAPI)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->widgetRepository->save($this->widget);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::save
     * @expectedException \CallbackHunterAPIv2\Exception\ResourceNotFoundException
     */
    public function testSaveThrowResourceNotFoundException()
    {
        $errorResponseBody = [
            'type'   => 'https://developers.callbackhunter.com/#error404',
            'title'  => 'Заправшиваемый ресурс не найден',
            'status' => 404,
            'detail' => 'Обратите внимание, что список доступных '.
                'ресурсов можно увидеть в документации по адресу '.
                'https://developers.callbackhunter.com/',
        ];

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($this->defaultWidgetToAPI);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToAPI)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->widgetRepository->save($this->widget);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::save
     * @expectedException \CallbackHunterAPIv2\Exception\Exception
     */
    public function testSaveThrowException()
    {
        $errorResponseBody = [
            'status' => 500,
        ];

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($this->defaultWidgetToAPI);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $this->defaultWidgetToAPI)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);

        $this->widgetRepository->save($this->widget);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::removeNullValues
     */
    public function testRemoveNullValues()
    {
        $data = [
            'foo' => 'bar',
            'baz' => null,
            'bar' => [
                'some'    => 'value',
                'another' => null,
            ],
            'cat' => [
                'unicorn' => null,
                'another' => null,
            ],
        ];
        $dataWithoutNull = [
            'foo' => 'bar',
            'bar' => [
                'some' => 'value',
            ],
        ];

        $this->widget->expects($this->once())
            ->method('toAPI')
            ->willReturn($data);

        $this->client->expects($this->once())
            ->method('requestPost')
            ->with($this->path, $dataWithoutNull)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn('{"foo":"bar"}');

        $settings = $this->createMock(SettingsInterface::class);
        $this->widget->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $images = $this->createMock(Images::class);
        $settings->expects($this->once())
            ->method('getImages')
            ->willReturn($images);

        $this->widgetFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->willReturn($this->createMock(WidgetInterface::class));

        foreach (Images::TYPES as $type) {
            $images
                ->expects($this->once())
                ->method('get'.$type)
                ->willReturn(
                    $this->createMock(AbstractImage::class)
                );
        }


        $this->widgetRepository->save($this->widget);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::getList
     */
    public function testGetList()
    {
        $responseData = [
            '_embedded' => [
                'widgets' => [
                    ['uid' => '123f6bcd4621d373cade4e832627b4f6'],
                    ['uid' => '456f6bcd4621d373cade4e832627b4f6'],
                ],
            ],
        ];
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
            ->willReturn(json_encode($responseData));

        $this->widgetFactory->expects($this->at(0))
            ->method('fromAPI')
            ->with($widgets[0])
            ->willReturn($this->widget);
        $this->widgetFactory->expects($this->at(1))
            ->method('fromAPI')
            ->with($widgets[1])
            ->willReturn($this->widget);

        $expected = [];
        foreach ($widgets as $data) {
            $widget = $this->widget;
            if (isset($data['uid'])) {
                $widget->setUid($data['uid']);
            }
            $expected[] = $widget;
        }

        $this->assertSame(
            $expected,
            $this->widgetRepository->getList($pagination)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::getList
     */
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

        $this->assertSame([], $this->widgetRepository->getList($pagination));
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::get
     */
    public function testGet()
    {
        $uid = '123f6bcd4621d373cade4e832627b4f6';
        $responseBody = ['foo' => 'bar'];

        $this->client->expects($this->once())
            ->method('requestGet')
            ->with($this->path.'/'.$uid)
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

        $this->assertSame($this->widget, $this->widgetRepository->get($uid));
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\WidgetRepository::get
     * @expectedException \CallbackHunterAPIv2\Exception\ResourceNotFoundException
     */
    public function testGetThrowResourceNotFoundException()
    {
        $errorResponseBody = [
            'type'   => 'https://developers.callbackhunter.com/#error404',
            'title'  => 'Заправшиваемый ресурс не найден',
            'status' => 404,
            'detail' => 'Обратите внимание, что список доступных '.
                'ресурсов можно увидеть в документации по адресу '.
                'https://developers.callbackhunter.com/',
        ];
        $uid = '123f6bcd4621d373cade4e832627b4f6';

        $this->client->expects($this->once())
            ->method('requestGet')
            ->with($this->path.'/'.$uid)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);
        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->widgetRepository->get($uid);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->createMock(ClientInterface::class);
        $this->widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->widget = $this->createMock(WidgetInterface::class);
        $this->widgetRepository = new WidgetRepository(
            $this->client,
            $this->widgetFactory
        );
    }
}
