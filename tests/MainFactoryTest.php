<?php

namespace CallbackHunterAPIv2\Tests;

use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\MainFactory;
use CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory\BackgroundRepositoryFactory;

class MainFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeWidgetFactory
     */
    public function testMakeWidgetFactory()
    {
        $this->assertInstanceOf(
            WidgetFactory::class,
            MainFactory::makeWidgetFactory()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeWidgetRepositoryFactory
     */
    public function testMakeWidgetRepositoryFactory()
    {
        $this->assertInstanceOf(
            WidgetRepositoryFactory::class,
            MainFactory::makeWidgetRepositoryFactory()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeDeprecatedWidgetRepositoryFactory
     */
    public function testMakeDeprecatedWidgetRepositoryFactory()
    {
        $this->assertInstanceOf(
            DeprecatedWidgetRepositoryFactory::class,
            MainFactory::makeDeprecatedWidgetRepositoryFactory()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeImagesBackgroundSliderRepositoryFactory
     */
    public function testMakeImagesBackgroundSliderRepositoryFactory()
    {
        $this->assertInstanceOf(
            BackgroundRepositoryFactory::class,
            MainFactory::makeImagesBackgroundSliderRepositoryFactory()
        );
    }
}
