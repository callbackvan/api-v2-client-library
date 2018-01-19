<?php

namespace CallbackHunterAPIv2;

use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ColorsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\PositionFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SizesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\TextsFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Variant\Widget\Image\Factory\BackgroundRepositoryFactory;

class MainFactory
{
    /**
     * @return WidgetFactory
     */
    public static function makeWidgetFactory()
    {
        $settingsFactory = new SettingsFactory(
            new ColorsFactory,
            new PositionFactory,
            new ImagesFactory,
            new ChannelsFactory,
            new SizesFactory,
            new TextsFactory
        );

        return new WidgetFactory($settingsFactory);
    }

    /**
     * @return DeprecatedWidgetFactory
     */
    public static function makeDeprecatedWidgetFactory()
    {
        return new DeprecatedWidgetFactory();
    }

    /**
     * @return WidgetRepositoryFactory
     */
    public static function makeWidgetRepositoryFactory()
    {
        return new WidgetRepositoryFactory(
            new ClientFactory(),
            self::makeWidgetFactory()
        );
    }

    /**
     * @return WidgetRepositoryFactory
     */
    public static function makeDeprecatedWidgetRepositoryFactory()
    {
        return new WidgetRepositoryFactory(
            new ClientFactory(),
            self::makeDeprecatedWidgetFactory()
        );
    }

    /**
     * @return BackgroundRepositoryFactory
     */
    public static function makeImagesBackgroundSliderRepositoryFactory()
    {
        return new BackgroundRepositoryFactory(
            new ClientFactory(),
            new BackgroundFactory()
        );
    }
}
