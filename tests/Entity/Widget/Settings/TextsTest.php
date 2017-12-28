<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Texts;
use PHPUnit\Framework\TestCase;

class TextsTest extends TestCase
{
    /** @var Texts */
    private $texts;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Texts::getSliderCallbackButton()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Texts::setSliderCallbackButton()
     */
    public function testSliderCallbackButton()
    {
        $this->assertNull($this->texts->getSliderCallbackButton());
        $this->texts->setSliderCallbackButton($this->example['sliderCallbackButton']);
        $this->assertEquals(
            $this->example['sliderCallbackButton'],
            $this->texts->getSliderCallbackButton()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Texts::getSliderTitle()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Texts::setSliderTitle()
     */
    public function testSliderTitle()
    {
        $this->assertNull($this->texts->getSliderTitle());
        $this->texts->setSliderTitle($this->example['sliderTitle']);
        $this->assertEquals(
            $this->example['sliderTitle'],
            $this->texts->getSliderTitle()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Texts::toAPI()
     */
    public function testToAPI()
    {
        $this->texts->setSliderCallbackButton($this->example['sliderCallbackButton']);
        $this->texts->setSliderTitle($this->example['sliderTitle']);

        $this->assertSame($this->example, $this->texts->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->texts = new Texts();
        $this->example = [
            'sliderCallbackButton' => 'Жду!',
            'sliderTitle' => 'Привет!',
        ];
    }
}
