<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Colors;
use PHPUnit\Framework\TestCase;

class ColorsTest extends TestCase
{
    /** @var Colors */
    private $colors;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::setIconBackground
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::getIconBackground
     */
    public function testIconBackground()
    {
        $this->colors->setIconBackground($this->example['iconBackground']);
        $this->assertSame($this->example['iconBackground'], $this->colors->getIconBackground());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::setBackgroundSlider()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::getBackgroundSlider()
     */
    public function testBackgroundSlider()
    {
        $this->colors->setBackgroundSlider($this->example['backgroundSlider']);
        $this->assertSame($this->example['backgroundSlider'], $this->colors->getBackgroundSlider());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::setSliderTextColor()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::getSliderTextColor()
     */
    public function testSliderTextColor()
    {
        $excepted = '000000';
        $this->assertNull($this->colors->getSliderTextColor());
        $this->colors->setSliderTextColor($excepted);
        $this->assertEquals($excepted, $this->colors->getSliderTextColor());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::toAPI()
     */
    public function testToAPIAll()
    {
        $this->colors->setIconBackground($this->example['iconBackground']);
        $this->colors->setBackgroundSlider($this->example['backgroundSlider']);
        $this->colors->setSliderTextColor($this->example['sliderTextColor']);

        $this->assertSame($this->example, $this->colors->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::toAPI()
     */
    public function testToAPIPartial()
    {
        $this->colors->setIconBackground($this->example['iconBackground']);
        $this->colors->setSliderTextColor($this->example['sliderTextColor']);
        $this->assertNotSame($this->example, $this->colors->toAPI());

        $expected = [
            'iconBackground' => $this->example['iconBackground'],
            'backgroundSlider' => null,
            'sliderTextColor' => $this->example['sliderTextColor'],
        ];

        $this->assertSame($expected, $this->colors->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->colors = new Colors();
        $this->example = [
            'iconBackground' => 'fff',
            'backgroundSlider' => 'ccc',
            'sliderTextColor' => '000',
        ];
    }
}
