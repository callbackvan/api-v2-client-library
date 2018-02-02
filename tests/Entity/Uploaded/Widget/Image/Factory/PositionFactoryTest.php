<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\PositionFactory;
use PHPUnit\Framework\TestCase;

class PositionFactoryTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\PositionFactory::fromAPI
     */
    public function testFromAPI()
    {
        $example = [
            'x' => 10,
            'y' => 65,
        ];

        $factory = new PositionFactory();
        $position = $factory->fromAPI($example);

        $this->assertSame($example['x'], $position->getX());
        $this->assertSame($example['y'], $position->getY());
    }
}
