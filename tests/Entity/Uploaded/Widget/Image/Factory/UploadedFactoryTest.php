<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\PositionFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactory;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\PositionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use PHPUnit\Framework\TestCase;

class UploadedFactoryTest extends TestCase
{
    /** @var UploadedFactory */
    private $factory;

    /** @var PositionFactoryInterface */
    private $positionFactory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactory::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactory::fromAPI
     */
    public function testFromAPI()
    {
        $example = [
            '_links'   => [
                'self'   => [
                    'href' => 'https://callbackhunter.com/uploaded/slide_image/sources/test.png',
                ],
                'widget' => [
                    'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                ],
            ],
            'position' => [
                'x' => '12',
                'y' => '65',
            ],
        ];

        $position = $this->createMock(PositionInterface::class);
        $this->positionFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($example['position'])
            ->willReturn($position);

        $uploaded = $this->factory->fromAPI($example);

        $this->assertInstanceOf(UploadedInterface::class, $uploaded);

        $this->assertSame(
            $example['_links']['self']['href'],
            $uploaded->getURL()
        );

        $this->assertSame(
            $position,
            $uploaded->getPosition()
        );
    }

    /**
     * @covers       \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactory::fromAPI
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     *
     * @dataProvider invalidDataProvider
     *
     * @param $example
     */
    public function testFromAPIThrowsInvalidArgument($example)
    {
        $this->factory->fromAPI($example);
    }

    public function invalidDataProvider()
    {
        $data = [
            [
                '_links'   => [
                    'self'   => [
                    ],
                    'widget' => [
                        'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                    ],
                ],
                'position' => [
                    'x' => '12',
                    'y' => '65',
                ],
            ],
            [
                '_links'   => [
                    'self'   => [
                        'href' => 'https://callbackhunter.com/uploaded/slide_image/sources/test.png',
                    ],
                    'widget' => [
                        'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                    ],
                ],
                'position' => [
                    'y' => '65',
                ],
            ],
            [
                '_links'   => [
                    'self'   => [
                        'href' => 'https://callbackhunter.com/uploaded/slide_image/sources/test.png',
                    ],
                    'widget' => [
                        'href' => 'https://callbackhunter.com/api/v2/widgets/123f6bcd4621d373cade4e832627b4f6',
                    ],
                ],
                'position' => [
                    'x' => '12',
                ],
            ],
        ];

        foreach ($data as $item) {
            yield [$item];
        }
    }

    protected function setUp()
    {
        parent::setUp();
        $this->factory = new UploadedFactory(
            $this->positionFactory = $this->createMock(
                PositionFactoryInterface::class
            )
        );
    }
}
