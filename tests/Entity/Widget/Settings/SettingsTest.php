<?php
/**
 * Created by PhpStorm.
 * User: vdvug_000
 * Date: 11.12.2017
 * Time: 11:08
 */

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Colors;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use CallbackHunterAPIv2\Entity\Widget\Settings\Position;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;

class SettingsTest extends \PHPUnit_Framework_TestCase
{
    /** @var Settings */
    private $entity;
    /** @var Colors */
    private $colors;
    /** @var Position */
    private $position;
    /** @var Images */
    private $images;
    /** @var Channels */
    private $channels;

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getColors
     */
    public function testGetColors()
    {
        $this->assertSame($this->colors, $this->entity->getColors());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getPosition
     */
    public function testGetPosition()
    {
        $this->assertSame($this->position, $this->entity->getPosition());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getImages
     */
    public function testGetImages()
    {
        $this->assertSame($this->images, $this->entity->getImages());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getChannels
     */
    public function testGetChannels()
    {
        $this->assertSame($this->channels, $this->entity->getChannels());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::toAPI
     */
    public function testToAPI()
    {
        $expected = [
            'colors'   => ['color' => '000000'],
            'position' => ['position' => 90],
            'images'   => ['images' => '13123123'],
            'channels' => ['channel' => 'tg'],
        ];
        $this->colors
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['colors']);

        $this->position
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['position']);

        $this->images
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['images']);

        $this->channels
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['channels']);

        $this->assertEquals($expected, $this->entity->toAPI());
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->entity = new Settings(
            $this->colors = $this->createMock(Colors::class),
            $this->position = $this->createMock(Position::class),
            $this->images = $this->createMock(Images::class),
            $this->channels = $this->createMock(Channels::class)
        );
    }
}
