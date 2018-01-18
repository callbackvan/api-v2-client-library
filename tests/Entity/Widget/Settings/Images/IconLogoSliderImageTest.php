<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\IconLogoSliderImage;

class IconLogoSliderImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\IconLogoSliderImage::__construct
     */
    public function testConstructor()
    {
        $entity = new IconLogoSliderImage;
        $imageName = 'test';
        $entity->setName($imageName);
        $expected = IconLogoSliderImage::BASE_URL.$imageName;
        $this->assertSame($expected, $entity->getURL());
    }
}
