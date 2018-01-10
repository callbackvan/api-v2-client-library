<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

class Images implements BaseEntityInterface
{
    const TYPES
        = [
            'ButtonLogo',
            'IconLogoSlider',
            'BackgroundSlider',
        ];

    /** @var ButtonLogoImage */
    private $buttonLogo;

    /** @var IconLogoSliderImage */
    private $iconLogoSlider;

    /** @var BackgroundSliderImage */
    private $backgroundSlider;

    /**
     * Images constructor.
     *
     * @param ButtonLogoImage       $buttonLogo
     * @param IconLogoSliderImage   $iconLogoSlider
     * @param BackgroundSliderImage $backgroundSlider
     */
    public function __construct(
        ButtonLogoImage $buttonLogo,
        IconLogoSliderImage $iconLogoSlider,
        BackgroundSliderImage $backgroundSlider
    ) {
        $this->buttonLogo = $buttonLogo;
        $this->iconLogoSlider = $iconLogoSlider;
        $this->backgroundSlider = $backgroundSlider;
    }

    /**
     * @return ButtonLogoImage
     */
    public function getButtonLogo()
    {
        return $this->buttonLogo;
    }

    /**
     * @return IconLogoSliderImage
     */
    public function getIconLogoSlider()
    {
        return $this->iconLogoSlider;
    }

    /**
     * @return BackgroundSliderImage
     */
    public function getBackgroundSlider()
    {
        return $this->backgroundSlider;
    }

    /**
     * @param BackgroundSliderImage $backgroundSlider
     */
    public function setBackgroundSlider(BackgroundSliderImage $backgroundSlider)
    {
        $this->backgroundSlider = $backgroundSlider;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'buttonLogo'       => $this->getButtonLogo()->getName(),
            'iconLogoSlider'   => $this->getIconLogoSlider()->getName(),
            'backgroundSlider' => $this->getBackgroundSlider()->getName(),
        ];
    }
}
