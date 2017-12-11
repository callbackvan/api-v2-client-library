<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage;

class BackgroundSliderImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\BackgroundSliderImage::__construct
     */
    public function testConstructor()
    {
        $entity = new BackgroundSliderImage;
        $entity->setName('test');
        $expected = 'https://cdn.callbackhunter.com/uploads/slide_image/test';
        $this->assertSame($expected, $entity->getURL());
    }
}
