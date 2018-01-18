<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Settings;
use SplSubject;

class Images implements BaseEntityInterface, \SplObserver
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

    public function update(SplSubject $subject)
    {
        if ($subject instanceof Settings) {
            $backgroundSlider = $this->getBackgroundSlider();
            switch ($subject->getBackgroundTypeForSlider()) {
                case Settings::BACKGROUND_TYPE_PRESET:
                    $backgroundSlider->setBaseUrl(
                        BackgroundSliderImage::PRESET_URL
                    );
                    break;
                case Settings::BACKGROUND_TYPE_FILE:
                    $backgroundSlider->setBaseUrl(
                        BackgroundSliderImage::BASE_URL
                    );
                    break;
            }
        }
    }
}
