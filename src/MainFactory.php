<?php

namespace CallbackHunterAPIv2;

use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ColorsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImagesFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\PositionFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory;
use CallbackHunterAPIv2\Repository\Factory\WidgetRepositoryFactory;

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
            new ChannelsFactory
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
}
