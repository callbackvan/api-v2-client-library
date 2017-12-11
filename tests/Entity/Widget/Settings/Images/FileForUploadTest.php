<?php
/**
 * Created by PhpStorm.
 * User: vdvug_000
 * Date: 11.12.2017
 * Time: 11:12
 */

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload;
use Psr\Http\Message\StreamInterface;

class FileForUploadTest extends \PHPUnit_Framework_TestCase
{
    /** @var FileForUpload */
    private $entity;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload::setStream
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload::getStream
     */
    public function testStream()
    {
        $stream = $this->createMock(StreamInterface::class);
        $this->entity->setStream($stream);
        $this->assertSame($stream, $this->entity->getStream());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload::setName
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload::getName
     */
    public function testName()
    {
        $name = 'test';
        $this->entity->setName($name);
        $this->assertSame($name, $this->entity->getName());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->entity = new FileForUpload;
    }
}
