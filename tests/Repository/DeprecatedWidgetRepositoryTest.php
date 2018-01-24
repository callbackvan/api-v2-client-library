<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidgetInterface;
use CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository;
use CallbackHunterAPIv2\ValueObject\Pagination;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Class WidgetRepositoryTest
 *
 * @package Tests\Repository
 * @covers  \CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository
 */
class DeprecatedWidgetRepositoryTest extends TestCase
{
    /** @var ClientInterface */
    private $client;

    /** @var DeprecatedWidgetInterface */
    private $deprecatedWidget;

    /** @var WidgetFactoryInterface */
    private $widgetFactory;

    /** @var DeprecatedWidgetRepository */
    private $widgetRepository;

    /** @var ResponseInterface */
    private $response;

    /** @var Pagination */
    private $pagination;

    /** @var string */
    private $path = 'deprecated_widgets';

    /** @var array */
    private $defaultQuery
        = [
            'limit'  => Pagination::DEFAULT_LIMIT,
            'offset' => Pagination::DEFAULT_OFFSET,
        ];

    public function widgetUidProvider()
    {
        return [
            ['123f6bcd4621d373cade4e832627b4f6'],
            [null],
        ];
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository::getList
     * @covers \CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository::checkResponse()
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

        $this->pagination
            ->expects($this->once())
            ->method('getLimit')
            ->willReturn(Pagination::DEFAULT_LIMIT);
        $this->pagination
            ->expects($this->once())
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
            ->willReturn($this->deprecatedWidget);
        $this->widgetFactory->expects($this->at(1))
            ->method('fromAPI')
            ->with($widgets[1])
            ->willReturn($this->deprecatedWidget);

        $expected = [];
        foreach ($widgets as $data) {
            $widget = $this->deprecatedWidget;
            if (isset($data['uid'])) {
                $widget->setUid($data['uid']);
            }
            $expected[] = $widget;
        }

        $this->assertSame(
            $expected,
            $this->widgetRepository->getList($this->pagination)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository::getList
     */
    public function testGetListReturnedEmptyResults()
    {
        $this->pagination
            ->expects($this->once())
            ->method('getLimit')
            ->willReturn(Pagination::DEFAULT_LIMIT);
        $this->pagination
            ->expects($this->once())
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

        $this->assertSame([], $this->widgetRepository->getList($this->pagination));
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository::checkResponse()
     * @covers \CallbackHunterAPIv2\Repository\DeprecatedWidgetRepository::getList()
     * @expectedException \CallbackHunterAPIv2\Exception\Exception
     */
    public function testSaveThrowException()
    {
        $this->pagination
            ->expects($this->once())
            ->method('getLimit')
            ->willReturn(Pagination::DEFAULT_LIMIT);
        $this->pagination
            ->expects($this->once())
            ->method('getOffset')
            ->willReturn(Pagination::DEFAULT_OFFSET);

        $errorResponseBody = [
            'status' => 500,
        ];

        $this->client->expects($this->once())
            ->method('requestGet')
            ->with($this->path, $this->defaultQuery)
            ->willReturn($this->response);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($errorResponseBody['status']);

        $this->widgetRepository->getList($this->pagination);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->pagination = $this->createMock(PaginationInterface::class);
        $this->client = $this->createMock(ClientInterface::class);
        $this->widgetFactory = $this->createMock(WidgetFactoryInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->deprecatedWidget = $this->createMock(DeprecatedWidgetInterface::class);
        $this->widgetRepository = new DeprecatedWidgetRepository(
            $this->client,
            $this->widgetFactory
        );
    }
}
