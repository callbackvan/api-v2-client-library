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
     * @covers \CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory::fromAPI
     */
    public function testFromAPI()
    {
        $this->assertInstanceOf(
            Background::class,
            $this->backgroundFactory->fromAPI([])
        );
        $this->assertEquals(
            [],
            $this->backgroundFactory->fromAPI([])->getBackgroundSlider()
        );

        $data = [
            'backgroundSlider' => [
                [
                    '_links' => [
                        'self' => [
                            'href' => BackgroundSliderImage::PRESET_URL
                                .'slider_1.png',
                        ],
                    ],
                    'value'  => 'slider_1.png',
                ],
                [
                    '_links' => [
                        'self' => [
                            'href' => BackgroundSliderImage::PRESET_URL
                                .'slider_2.png',
                        ],
                    ],
                    'value'  => 'slider_2.png',
                ],
            ],
        ];

        $background = $this->backgroundFactory->fromAPI($data);

        foreach ($background->getBackgroundSlider() as $key => $backgroundSlider) {
            /* @var BackgroundSliderImage $backgroundSlider */

            $imageValue = $data['backgroundSlider'][$key]['value'];
            $link = $data['backgroundSlider'][$key]['_links']['self']['href'];

            $this->assertInstanceOf(
                BackgroundSliderImage::class,
                $backgroundSlider
            );
            $this->assertEquals($imageValue, $backgroundSlider->getName());
            $this->assertEquals($link, $backgroundSlider->getURL());
        }
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory::fromAPI()
     */
    public function testInvalidMethodName()
    {
        $data = [
            'someMethod' => [],
        ];

        $background = $this->backgroundFactory->fromAPI($data);

        $this->assertInstanceOf(
            Background::class,
            $this->backgroundFactory->fromAPI([])
        );
        $this->assertEquals([], $background->getBackgroundSlider());
    }

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->backgroundFactory = new BackgroundFactory();
    }
}
