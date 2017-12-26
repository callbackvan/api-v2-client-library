<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Sizes;
use PHPUnit\Framework\TestCase;

class SizesTest extends TestCase
{
    /** @var Sizes */
    private $sizes;

    /** @var array */
    private $example;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Sizes::getButton()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Sizes::setButton()
     */
    public function testButton()
    {
        $this->assertNull($this->sizes->getButton());
        $this->sizes->setButton($this->example['button']);
        $this->assertEquals(
            $this->example['button'], $this->sizes->getButton()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Sizes::toAPI()
     */
    public function testToAPI()
    {
        $this->sizes->setButton($this->example['button']);

        $this->assertSame($this->example, $this->sizes->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->sizes = new Sizes();
        $this->example = [
            'button' => 55,
        ];
    }
}
