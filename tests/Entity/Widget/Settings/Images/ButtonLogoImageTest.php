<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\ButtonLogoImage;

class ButtonLogoImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\ButtonLogoImage::__construct
     */
    public function testConstructor()
    {
        $entity = new ButtonLogoImage;
        $imageName = 'test';
        $entity->setName($imageName);
        $expected = ButtonLogoImage::BASE_URL.$imageName;
        $this->assertSame($expected, $entity->getURL());
    }
}
