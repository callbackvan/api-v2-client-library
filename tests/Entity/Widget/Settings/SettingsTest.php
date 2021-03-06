<?php

namespace CallbackHunterAPIv2\Tests\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Colors;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use CallbackHunterAPIv2\Entity\Widget\Settings\Position;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use CallbackHunterAPIv2\Entity\Widget\Settings\Sizes;
use CallbackHunterAPIv2\Entity\Widget\Settings\Texts;

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
    /** @var Sizes */
    private $sizes;
    /** @var Texts */
    private $texts;

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
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getSizes
     */
    public function testGetSizes()
    {
        $this->assertSame($this->sizes, $this->entity->getSizes());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getTexts
     */
    public function testGetTexts()
    {
        $this->assertSame($this->texts, $this->entity->getTexts());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::toAPI
     */
    public function testToAPI()
    {
        $expected = [
            'backgroundTypeForSlider' => 'preset',

            'colors'   => [
                'color' => '000000',
            ],
            'position' => [
                'position' => 90,
            ],
            'images'   => [
                'images' => '13123123',
            ],
            'channels' => [
                'channel' => 'tg',
            ],
            'sizes'    => [
                'button' => 55,
            ],
            'texts'    => [
                'sliderCallbackButton' => 'Жду!',
                'sliderTitle'          => 'Привет!',
            ],
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

        $this->sizes
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['sizes']);

        $this->texts
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($expected['texts']);

        $this->entity
            ->setBackgroundTypeForSlider($expected['backgroundTypeForSlider']);

        $this->assertEquals($expected, $this->entity->toAPI());
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getBackgroundTypeForSlider
     */
    public function testBackgroundTypeForSliderDefault()
    {
        $this->assertNull($this->entity->getBackgroundTypeForSlider());
    }

    /**
     * @covers       \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::setBackgroundTypeForSlider
     * @covers       \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::getBackgroundTypeForSlider
     * @dataProvider validBackgroundTypeProvider
     *
     * @param string $type
     */
    public function testBackgroundTypeForSlider($type)
    {
        $this->entity->setBackgroundTypeForSlider($type);
        $this->assertSame(
            strtolower($type),
            $this->entity->getBackgroundTypeForSlider()
        );
    }

    public function validBackgroundTypeProvider()
    {
        $result = [];

        foreach (Settings::BACKGROUND_TYPES as $type) {
            foreach ([$type, strtoupper($type), ucfirst($type)] as $item) {
                $result[$item] = [$item];
            }
        }

        return $result;
    }

    /**
     * @covers            \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::setBackgroundTypeForSlider
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testBackgroundTypeForSliderThrowInvalidArgument()
    {
        $this->entity->setBackgroundTypeForSlider('test');
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::__construct
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::attach
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::notify
     */
    public function testImagesAttached()
    {
        $observer = $this->images;
        $this->expectSplObserverUpdate($observer);

        $this->entity->notify();
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::attach
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::notify
     */
    public function testAttachAndNotify()
    {
        $observer = $this->createMock(\SplObserver::class);
        $this->expectSplObserverUpdate($observer);

        $this->entity->attach($observer);
        $this->entity->notify();
    }

    /**
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::detach
     * @covers \CallbackHunterAPIv2\Entity\Widget\Settings\Settings::notify
     */
    public function testDetachAndNotify()
    {
        $observer = $this->images;
        $observer
            ->expects($this->never())
            ->method('update');

        $this->entity->detach($observer);
        $this->entity->notify();
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
            $this->channels = $this->createMock(Channels::class),
            $this->sizes = $this->createMock(Sizes::class),
            $this->texts = $this->createMock(Texts::class)
        );
    }

    /**
     * @param \PHPUnit_Framework_MockObject_MockObject $observer
     */
    private function expectSplObserverUpdate($observer)
    {
        $observer
            ->expects($this->once())
            ->method('update')
            ->with($this->entity);
    }
}
