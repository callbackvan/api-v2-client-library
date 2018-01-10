<?php

namespace CallbackHunterAPIv2\Tests\Repository\Variant\Widget\Image;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\BackgroundInterface;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactoryInterface;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Репозиторий вариантов фонов виджета
 *
 * @package CallbackHunterAPIv2\Tests\Repository\Variant\Widget\Image
 */
class BackgroundRepositoryTest extends TestCase
{
    /**
     * API клиент
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * Фабрика вариантов фонов
     *
     * @var BackgroundFactoryInterface
     */
    private $backgroundFactory;

    /**
     * Репозитоий вариантов фонов виджета
     *
     * @var BackgroundRepository
     */
    private $backgroundRepository;

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->createMock(ClientInterface::class);
        $this->backgroundFactory = $this->createMock(BackgroundFactoryInterface::class);

        $this->backgroundRepository = new BackgroundRepository(
            $this->client,
            $this->backgroundFactory
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository::__construct()
     * @covers \CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository::get()
     */
    public function testGet()
    {
        $testData = json_encode([
            '_links'   => [
                'self' => [
                    'href' => '/api/v2/variants/widgets/images/backgrounds',
                ],
            ],
            '_embedded' => [
                'backgroundSlider' => [
                    [
                        '_links' => [
                            'self' => [
                                'href' => 'https://callbackhunter.com/uploads/slide_image/preset/slider_1.png',
                            ],
                        ],
                        'value'  => 'slider_1.png'
                    ],
                    [
                        '_links' => [
                            'self' => [
                                'href' => 'https://callbackhunter.com/uploads/slide_image/preset/slider_2.png',
                            ],
                        ],
                        'value'  => 'slider_2.png'
                    ]
                ]
            ]
        ]);

        $response = $this->createMock(ResponseInterface::class);
        $this->client->expects($this->once())
            ->method('requestGet')
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($testData);

        $background = $this->createMock(BackgroundInterface::class);

        $this->backgroundFactory->expects($this->once())
            ->method('fromAPI')
            ->willReturn($background);

        $responseFromRepository = $this->backgroundRepository->get();

        $this->assertSame($background, $responseFromRepository);
        $this->assertInstanceOf(BackgroundInterface::class, $responseFromRepository);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository::__construct()
     * @covers \CallbackHunterAPIv2\Repository\Variant\Widget\Image\BackgroundRepository::get()
     */
    public function testEmptyGet()
    {
        $testData = json_encode([]);

        $response = $this->createMock(ResponseInterface::class);
        $this->client->expects($this->once())
            ->method('requestGet')
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($testData);

        $responseFromRepository = $this->backgroundRepository->get();

        $this->assertNull($responseFromRepository);
    }
}
