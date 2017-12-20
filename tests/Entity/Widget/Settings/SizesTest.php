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
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Sizes::getButtonSize()
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Sizes::setButtonSize()
     */
    public function testButtonSize()
    {
        $this->assertNull($this->sizes->getButtonSize());
        $this->sizes->setButtonSize($this->example['buttonSize']);
        $this->assertEquals($this->example['buttonSize'], $this->sizes->getButtonSize());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Sizes::toAPI()
     */
    public function testToAPI()
    {
        $this->sizes->setButtonSize($this->example['buttonSize']);

        $this->assertSame($this->example, $this->sizes->toAPI());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->sizes = new Sizes();
        $this->example = [
            'buttonSize' => 55
        ];
    }
}
