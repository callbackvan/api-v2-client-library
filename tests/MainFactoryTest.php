<?php

namespace CallbackHunterAPIv2\Tests;

use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\MainFactory;
use CallbackHunterAPIv2\Repository\Factory\CurrentProfileRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\TrialRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetPhoneRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory;
use CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\Factory\UploadedRepositoryFactory;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory\BackgroundRepositoryFactory;

class MainFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeCurrentProfileRepositoryFactory
     */
    public function testMakeCurrentProfileRepositoryFactory()
    {
        $this->assertInstanceOf(
            CurrentProfileRepositoryFactory::class,
            MainFactory::makeCurrentProfileRepositoryFactory()
        );
    }

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

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeUploadedRepositoryFactory
     */
    public function testMakeUploadedRepositoryFactory()
    {
        $this->assertInstanceOf(
            UploadedRepositoryFactory::class,
            MainFactory::makeUploadedRepositoryFactory()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeTrialRepositoryFactory
     */
    public function testMakeTrialRepositoryFactory()
    {
        $this->assertInstanceOf(
            TrialRepositoryFactory::class,
            MainFactory::makeTrialRepositoryFactory()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeTariffStatusRepositoryFactory
     */
    public function testMakeTariffStatusRepositoryFactory()
    {
        $this->assertInstanceOf(
            TariffStatusRepositoryFactory::class,
            MainFactory::makeTariffStatusRepositoryFactory()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\MainFactory::makeWidgetPhoneRepositoryFactory
     */
    public function testMakeWidgetPhoneRepositoryFactory()
    {
        $this->assertInstanceOf(
            WidgetPhoneRepositoryFactory::class,
            MainFactory::makeWidgetPhoneRepositoryFactory()
        );
    }
}
