<?php

namespace CallbackHunterAPIv2;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\PositionFactory as UploadedPositionFactory;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\SizesFactory as UploadedSizesFactory;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactory;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactory;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\DeprecatedWidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ColorsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\PositionFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SizesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\TextsFactory;
use CallbackHunterAPIv2\Repository\Factory\DeprecatedWidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\TariffStatusRepositoryFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;
use CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\Factory\UploadedRepositoryFactory;
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
     * @return DeprecatedWidgetRepositoryFactory
     */
    public static function makeDeprecatedWidgetRepositoryFactory()
    {
        return new DeprecatedWidgetRepositoryFactory(
            new ClientFactory(),
            new DeprecatedWidgetFactory
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

    /**
     * @return UploadedRepositoryFactory
     */
    public static function makeUploadedRepositoryFactory()
    {
        $uploadedFactory = new UploadedFactory(
            new UploadedPositionFactory(),
            new UploadedSizesFactory()
        );

        return new UploadedRepositoryFactory(
            new ClientFactory(),
            new UploadedCollectionFactory($uploadedFactory),
            $uploadedFactory
        );
    }

    /**
    * @return TariffStatusRepositoryFactory
    */
    public static function makeTariffStatusRepositoryFactory()
    {
        return new TariffStatusRepositoryFactory(
            new ClientFactory()
        );
    }
}
