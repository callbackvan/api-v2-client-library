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
        $entity->setName('test');
        $expected = 'https://cdn.callbackhunter.com/uploads/brand_logo/test';
        $this->assertSame($expected, $entity->getURL());
    }
}
