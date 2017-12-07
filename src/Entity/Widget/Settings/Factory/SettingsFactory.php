<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Factory\ChannelsFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use CallbackHunterAPIv2\Entity\Widget\Settings\SettingsInterface;

class SettingsFactory
{
    /**
     * @var ColorsFactory
     */
    private $colorsFactory;

    /**
     * @var PositionFactory
     */
    private $positionFactory;

    /**
     * @var ImagesFactory
     */
    private $imagesFactory;

    /**
     * @var ChannelsFactory
     */
    private $channelsFactory;

    public function __construct($colorsFactory, $positionFactory, $imagesFactory, $channelsFactory)
    {
        $this->colorsFactory = $colorsFactory;
        $this->positionFactory = $positionFactory;
        $this->imagesFactory = $imagesFactory;
        $this->channelsFactory = $channelsFactory;
    }

    /**
     * @param array $data
     *
     * @return SettingsInterface
     */
    public function fromAPI(array $data)
    {
        $colors = $this->colorsFactory->fromAPI(isset($data['colors']) ? $data['colors'] : []);
        $position = $this->positionFactory->fromAPI(isset($data['position']) ? $data['position'] : []);
        $images = $this->imagesFactory->fromAPI(isset($data['images']) ? $data['images'] : []);
        $channels = $this->channelsFactory->fromAPI(isset($data['channels']) ? $data['channels'] : []);

        return new Settings(
            $colors,
            $position,
            $images,
            $channels
        );
    }
}
