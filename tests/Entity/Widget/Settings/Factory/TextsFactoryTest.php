<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\TextsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Texts;
use PHPUnit\Framework\TestCase;

class TextsFactoryTest extends TestCase
{
    /** @var TextsFactory */
    private $textsFactory;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\TextsFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $response = $this->textsFactory->fromAPI($this->example);
        $this->assertInstanceOf(Texts::class, $response);

        $expected = new Texts();
        $expected->setSliderCallbackButton($this->example['sliderCallbackButton']);
        $expected->setSliderTitle($this->example['sliderTitle']);

        $this->assertEquals($expected, $response);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->textsFactory = new TextsFactory();
        $this->example = [
            'sliderCallbackButton' => 'Жду!',
            'sliderTitle' => 'Привет!',
        ];
    }
}
