<?php

namespace CallbackHunterAPIv2\Tests\Entity\Variant\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Background;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;
use PHPUnit\Framework\TestCase;

/**
 * Фабрика вариантов фонов виджета
 *
 * @package CallbackHunterAPIv2\Tests\Entity\Variant\Widget\Image\Factory
 */
class BackgroundFactoryTest extends TestCase
{
    /**
     * Варианты фонов виджета
     *
     * @var BackgroundFactory
     */
    private $backgroundFactory;

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->backgroundFactory = new BackgroundFactory();
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $this->assertInstanceOf(Background::class, $this->backgroundFactory->fromAPI([]));
        $this->assertEquals([], $this->backgroundFactory->fromAPI([])->getBackgroundSlider());

        $data = [
            'backgroundSlider' => [
                [
                    '_links' => [
                        'self' => [
                            'self' => 'https://callbackhunter.com/uploads/slide_image/preset/slider_1.png'
                        ]
                    ],
                    'value' => 'slider_1.png'
                ],
                [
                    '_links' => [
                        'self' => [
                            'self' => 'https://callbackhunter.com/uploads/slide_image/preset/slider_2.png'
                        ]
                    ],
                    'value' => 'slider_2.png'
                ]
            ]
        ];

        $background = $this->backgroundFactory->fromAPI($data);

        foreach ($background->getBackgroundSlider() as $key => $backgroundSlider) {
            /* @var BackgroundSliderImage $backgroundSlider */

            $imageValue = $data['backgroundSlider'][$key]['value'];

            $this->assertEquals($imageValue, $backgroundSlider->getName());
            $this->assertInstanceOf(BackgroundSliderImage::class, $backgroundSlider);
        }
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory::fromAPI()
     */
    public function testInvalidMethodName()
    {
        $data = [
            'someMethod' => []
        ];

        $background = $this->backgroundFactory->fromAPI($data);

        $this->assertInstanceOf(Background::class, $this->backgroundFactory->fromAPI([]));
        $this->assertEquals([], $background->getBackgroundSlider());
    }
}
