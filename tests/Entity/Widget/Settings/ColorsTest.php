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
        $this->assertSame(
            $this->example['iconBackground'],
            $this->colors->getIconBackground()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::setBackgroundSlider()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::getBackgroundSlider()
     */
    public function testBackgroundSlider()
    {
        $this->colors->setBackgroundSlider($this->example['backgroundSlider']);
        $this->assertSame(
            $this->example['backgroundSlider'],
            $this->colors->getBackgroundSlider()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::setSliderText()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::getSliderText()
     */
    public function testSliderText()
    {
        $excepted = '000000';
        $this->assertNull($this->colors->getSliderText());
        $this->colors->setSliderText($excepted);
        $this->assertEquals($excepted, $this->colors->getSliderText());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::setSliderIcons
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::getSliderIcons
     */
    public function testSliderIcons()
    {
        $excepted = '000000';
        $this->assertNull($this->colors->getSliderIcons());
        $this->colors->setSliderIcons($excepted);
        $this->assertEquals($excepted, $this->colors->getSliderIcons());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::toAPI()
     */
    public function testToAPIAll()
    {
        $this->colors->setIconBackground($this->example['iconBackground']);
        $this->colors->setBackgroundSlider($this->example['backgroundSlider']);
        $this->colors->setSliderText($this->example['sliderText']);
        $this->colors->setSliderIcons($this->example['sliderIcons']);

        $this->assertSame($this->example, $this->colors->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Colors::toAPI()
     */
    public function testToAPIPartial()
    {
        $this->colors->setIconBackground($this->example['iconBackground']);
        $this->colors->setSliderText($this->example['sliderText']);
        $this->assertNotSame($this->example, $this->colors->toAPI());

        $expected = [
            'iconBackground'   => $this->example['iconBackground'],
            'backgroundSlider' => null,
            'sliderText'       => $this->example['sliderText'],
            'sliderIcons'      => null,
        ];

        $this->assertSame($expected, $this->colors->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->colors = new Colors();
        $this->example = [
            'iconBackground'   => 'fff',
            'backgroundSlider' => 'ccc',
            'sliderText'       => '000',
            'sliderIcons'      => '000',
        ];
    }
}
