<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SizesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Sizes;
use PHPUnit\Framework\TestCase;

class SizesFactoryTest extends TestCase
{
    /** @var SizesFactory */
    private $sizesFactory;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SizesFactory::fromAPI()
     */
    public function testFromAPI()
    {
        $response = $this->sizesFactory->fromAPI($this->example);
        $this->assertInstanceOf(Sizes::class, $response);

        $expected = new Sizes();
        $expected->setButton($this->example['button']);

        $this->assertEquals($expected, $response);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->sizesFactory = new SizesFactory();
        $this->example = [
            'button' => false,
        ];
    }
}
