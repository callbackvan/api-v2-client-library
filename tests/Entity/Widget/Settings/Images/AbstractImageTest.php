<?php
/**
 * Created by PhpStorm.
 * User: vdvug_000
 * Date: 11.12.2017
 * Time: 11:00
 */

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage;
use CallbackHunterAPIv2\Type\FileForUploadInterface;

class AbstractImageTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractImage */
    private $entity;
    /** @var string */
    private $baseUrl = 'https://example.com/';

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::getURL
     */
    public function testGetURL()
    {
        $name = 'test';
        $this->entity->setName($name);
        $this->assertSame(
            $this->baseUrl.$name,
            $this->entity->getURL()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::setBaseUrl
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::getUrl
     */
    public function testBaseUrl()
    {
        $name = 'test';
        $baseUrl = 'https://google.com/';

        $this->entity->setName($name);
        $this->entity->setBaseUrl($baseUrl);
        $this->assertSame(
            $baseUrl.$name,
            $this->entity->getURL()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::setName
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::getName
     */
    public function testName()
    {
        $name = 'test';
        $this->entity->setName($name);
        $this->assertSame($name, $this->entity->getName());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::setForUpload
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage::getForUpload
     */
    public function testForUpload()
    {
        $forUpload = $this->createMock(
            FileForUploadInterface::class
        );

        $this->entity->setForUpload($forUpload);
        $this->assertSame($forUpload, $this->entity->getForUpload());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->entity = $this
            ->getMockBuilder(AbstractImage::class)
            ->setConstructorArgs([$this->baseUrl])
            ->setMethods()
            ->getMock();
    }
}
