<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Colors;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ColorsFactory;
use PHPUnit\Framework\TestCase;

class ColorsFactoryTest extends TestCase
{
    /** @var ColorsFactory */
    private $colorsFactory;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ColorsFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $response = $this->colorsFactory->fromAPI($this->example);
        $this->assertInstanceOf(Colors::class, $response);

        $expected = (new Colors())
            ->setIconBackground($this->example['iconBackground'])
            ->setBackgroundSlider($this->example['backgroundSlider'])
            ->setSliderText($this->example['sliderText'])
            ->setSliderIcons($this->example['sliderIcons']);

        $this->assertEquals($expected, $response);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->colorsFactory = new ColorsFactory();
        $this->example = [
            'iconBackground'   => 'ccc',
            'backgroundSlider' => 'fff',
            'sliderText'       => '000',
            'sliderIcons'      => 'ddd',
        ];
    }
}
