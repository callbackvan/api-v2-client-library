<?php

namespace Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use PHPUnit\Framework\TestCase;

class ColorsTest extends TestCase
{
    /** @var Images */
    private $images;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getButtonLogo
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setButtonLogo
     */
    public function testButtonLogo()
    {
        $this->images->setButtonLogo($this->example['buttonLogo']);
        $this->assertSame($this->example['buttonLogo'], $this->images->getButtonLogo());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getIconLogoSlider
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setIconLogoSlider
     */
    public function testIconLogoSlider()
    {
        $this->images->setIconLogoSlider($this->example['iconLogoSlider']);
        $this->assertSame($this->example['iconLogoSlider'], $this->images->getIconLogoSlider());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::getBackgroundSlider
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::setBackgroundSlider
     */
    public function testGetBackgroundSlider()
    {
        $this->images->setBackgroundSlider($this->example['backgroundSlider']);
        $this->assertSame($this->example['backgroundSlider'], $this->images->getBackgroundSlider());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::toApi()
     */
    public function testToApiAll()
    {
        $this->images->setButtonLogo($this->example['buttonLogo']);
        $this->images->setIconLogoSlider($this->example['iconLogoSlider']);
        $this->images->setBackgroundSlider($this->example['backgroundSlider']);

        $this->assertSame($this->example, $this->images->toApi());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images::toApi()
     */
    public function testToApiPartial()
    {
        $this->images->setButtonLogo($this->example['buttonLogo']);

        $expected = [
            'buttonLogo' => $this->example['buttonLogo'],
            'iconLogoSlider' => null,
            'backgroundSlider' => null,
        ];

        $this->assertSame($expected, $this->images->toApi());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->images = new Images();
        $this->example = [
            'buttonLogo' => 'fff',
            'iconLogoSlider' => 'ccc',
            'backgroundSlider' => 'bbb',
        ];
    }
}
