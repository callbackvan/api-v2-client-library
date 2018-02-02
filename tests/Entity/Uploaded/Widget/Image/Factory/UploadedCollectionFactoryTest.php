<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollectionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactory;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use PHPUnit\Framework\TestCase;

class UploadedCollectionFactoryTest extends TestCase
{
    private $factory;
    private $uploadedFactory;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactory::__construct
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactory::fromAPI
     */
    public function testFromAPI()
    {
        $example = [
            '_links'    => [
                'self'   => [
                    'href' => 'test',
                ],
                'widget' => [
                    'href' => 'test',
                ],
            ],
            '_embedded' => [
                'buttonLogo'       => [
                    ['test 0'],
                ],
                'iconLogoSlider'   => [
                    ['test 1'],
                ],
                'backgroundSlider' => [
                    ['test 2'],
                ],
            ],
        ];

        $buttonLogo = $this->createMock(
            UploadedInterface::class
        );
        $this->uploadedFactory
            ->expects($this->at(0))
            ->method('fromAPI')
            ->with($example['_embedded']['buttonLogo'][0])
            ->willReturn($buttonLogo);

        $iconLogoSlider = $this->createMock(
            UploadedInterface::class
        );
        $this->uploadedFactory
            ->expects($this->at(1))
            ->method('fromAPI')
            ->with($example['_embedded']['iconLogoSlider'][0])
            ->willReturn($iconLogoSlider);

        $backgroundSlider = $this->createMock(
            UploadedInterface::class
        );
        $this->uploadedFactory
            ->expects($this->at(2))
            ->method('fromAPI')
            ->with($example['_embedded']['backgroundSlider'][0])
            ->willReturn($backgroundSlider);

        $collection = $this->factory->fromAPI($example);
        $this->assertInstanceOf(
            UploadedCollectionInterface::class,
            $collection
        );

        $data = $collection->getButtonLogo();
        $this->assertCount(1, $data);
        $this->assertSame($buttonLogo, reset($data));

        $data = $collection->getIconLogoSlider();
        $this->assertCount(1, $data);
        $this->assertSame($iconLogoSlider, reset($data));

        $data = $collection->getBackgroundSlider();
        $this->assertCount(1, $data);
        $this->assertSame($backgroundSlider, reset($data));
    }

    protected function setUp()
    {
        parent::setUp();
        $this->factory = new UploadedCollectionFactory(
            $this->uploadedFactory = $this->createMock(
                UploadedFactoryInterface::class
            )
        );
    }
}
