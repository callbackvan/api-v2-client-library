<?php

namespace CallbackHunterAPIv2\Tests\ValueObject;

use CallbackHunterAPIv2\ValueObject\ActivateTrialArguments;
use PHPUnit\Framework\TestCase;

class ActivateTrialArgumentsTest extends TestCase
{
    /** @var ActivateTrialArguments */
    private $trial;

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\ActivateTrialArguments::offsetSet
     */
    public function testOffsetSet()
    {
        $offset = 'accountUID';
        $value = 'foo-bar-baz';

        $this->trial[$offset] = $value;
        $this->assertEquals($value, $this->trial[$offset]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\ActivateTrialArguments::offsetSet
     */
    public function testOffsetSetWithoutOffset()
    {
        $value = 'foo-bar-baz';
        $this->trial[] = $value;

        $this->assertEquals($value, $this->trial[0]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\ActivateTrialArguments::offsetExists
     */
    public function testOffsetExists()
    {
        $offset = 'accountUID';
        $value = 'foo-bar-baz';

        $this->trial[$offset] = $value;
        $this->assertNotEmpty($this->trial[$offset]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\ActivateTrialArguments::offsetUnset
     */
    public function testOffsetUnset()
    {
        $offset = 'accountUID';
        $value = 'foo-bar-baz';

        $this->trial[$offset] = $value;
        unset($this->trial[$offset]);
        $this->assertNull($this->trial[$offset]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\ActivateTrialArguments::offsetGet
     */
    public function testOffsetGet()
    {
        $offset = 'accountUID';
        $value = 'foo-bar-baz';

        $this->trial[$offset] = $value;
        $this->assertEquals($value, $this->trial[$offset]);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->trial = new ActivateTrialArguments();
    }
}
