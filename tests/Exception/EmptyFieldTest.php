<?php

namespace CallbackHunterAPIv2\Tests\Exception;

use CallbackHunterAPIv2\Exception\EmptyField;

class EmptyFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Exception\EmptyField::__construct
     */
    public function testConstructor()
    {
        $exception = new EmptyField('test');
        $this->assertSame(
            'Field "test" is empty',
            $exception->getMessage()
        );
    }
}
