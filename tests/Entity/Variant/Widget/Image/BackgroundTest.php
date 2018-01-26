<?php

namespace CallbackHunterAPIv2\Tests\Entity\Variant\Widget\Image;

use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Background;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;
use PHPUnit\Framework\TestCase;

/**
 * Варианты фонов виджета
 *
 * @package CallbackHunterAPIv2\Tests\Entity\Variant\Widget\Image
 */
class BackgroundTest extends TestCase
{
    /**
     * Варианты фонов виджета
     *
     * @var Background
     */
    private $background;

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->background = new Background();
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Variant\Widget\Image\Background::getBackgroundSlider
     * @covers \CallbackHunterAPIv2\Entity\Variant\Widget\Image\Background::setBackgroundSlider
     */
    public function testBackgroundSlider()
    {
        $image = $this->createMock(BackgroundSliderImage::class);

        $excepted = [
            $image
        ];

        $this->assertEquals([], $this->background->getBackgroundSlider());
        $this->background->setBackgroundSlider($excepted);
        $this->assertEquals($excepted, $this->background->getBackgroundSlider());
    }
}
