<?php

namespace CallbackHunterAPIv2\Tests\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\SizesFactory;
use PHPUnit\Framework\TestCase;

class SizesFactoryTest extends TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\SizesFactory::fromAPI
     */
    public function testFromAPI()
    {
        $example = [
            'width'  => 10,
            'height' => 65,
        ];

        $factory = new SizesFactory();
        $position = $factory->fromAPI($example);

        $this->assertSame($example['width'], $position->getWidth());
        $this->assertSame($example['height'], $position->getHeight());
    }
}
