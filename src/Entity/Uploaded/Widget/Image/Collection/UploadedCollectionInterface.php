<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;

interface UploadedCollectionInterface
{
    const TYPE_BUTTON_LOGO = 'buttonLogo';
    const TYPE_ICON_LOGO_SLIDER = 'iconLogoSlider';
    const TYPE_BACKGROUND_SLIDER = 'backgroundSlider';

    const TYPES
        = [
            self::TYPE_BUTTON_LOGO,
            self::TYPE_ICON_LOGO_SLIDER,
            self::TYPE_BACKGROUND_SLIDER,
        ];

    /**
     * @return UploadedInterface[]
     */
    public function getButtonLogo();

    /**
     * @return UploadedInterface[]
     */
    public function getIconLogoSlider();

    /**
     * @return UploadedInterface[]
     */
    public function getBackgroundSlider();
}
