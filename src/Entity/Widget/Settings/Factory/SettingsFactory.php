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

    /**
     * @var SizesFactory
     */
    private $sizesFactory;

    /**
     * @var TextsFactory
     */
    private $textsFactory;

    public function __construct(
        ColorsFactory $colorsFactory,
        PositionFactory $positionFactory,
        ImagesFactory $imagesFactory,
        ChannelsFactory $channelsFactory,
        SizesFactory $sizesFactory,
        TextsFactory $textsFactory
    ) {
        $this->colorsFactory = $colorsFactory;
        $this->positionFactory = $positionFactory;
        $this->imagesFactory = $imagesFactory;
        $this->channelsFactory = $channelsFactory;
        $this->sizesFactory = $sizesFactory;
        $this->textsFactory = $textsFactory;
    }

    /**
     * @param array $data
     *
     * @return SettingsInterface
     */
    public function fromAPI(array $data)
    {
        $colors = $this->colorsFactory->fromAPI(
            isset($data['colors']) ? $data['colors'] : []
        );
        $position = $this->positionFactory->fromAPI(
            isset($data['position']) ? $data['position'] : []
        );
        $images = $this->imagesFactory->fromAPI(
            isset($data['images']) ? $data['images'] : []
        );
        $channels = $this->channelsFactory->fromAPI(
            isset($data['channels']) ? $data['channels'] : []
        );

        $sizes = $this->sizesFactory->fromAPI(
            isset($data['sizes']) ? $data['sizes'] : []
        );

        $texts = $this->textsFactory->fromAPI(
            isset($data['texts']) ? $data['texts'] : []
        );

        return new Settings(
            $colors,
            $position,
            $images,
            $channels,
            $sizes,
            $texts
        );
    }
}
