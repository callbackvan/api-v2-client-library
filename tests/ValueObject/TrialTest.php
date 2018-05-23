<?php

namespace CallbackHunterAPIv2\Tests\ValueObject;

use CallbackHunterAPIv2\ValueObject\Trial;
use PHPUnit\Framework\TestCase;

class TrialTest extends TestCase
{
    /** @var Trial */
    private $trial;

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Trial::offsetSet
     */
    public function testOffsetSet()
    {
        $offset = 'accountUID';
        $value = 'foo-bar-baz';

        $this->trial[$offset] = $value;
        $this->assertEquals($value, $this->trial[$offset]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Trial::offsetSet
     */
    public function testOffsetSetWithoutOffset()
    {
        $value = 'foo-bar-baz';
        $this->trial[] = $value;

        $this->assertEquals($value, $this->trial[0]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Trial::offsetExists
     */
    public function testOffsetExists()
    {
        $offset = 'accountUID';
        $value = 'foo-bar-baz';

        $this->trial[$offset] = $value;
        $this->assertNotNull($this->trial[$offset]);
    }

    /**
     * @covers \CallbackHunterAPIv2\ValueObject\Trial::offsetUnset
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
     * @covers \CallbackHunterAPIv2\ValueObject\Trial::offsetGet
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
        $this->trial = new Trial();
    }
}
