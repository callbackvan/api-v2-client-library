<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

class Images implements BaseEntityInterface
{
    /** @var ButtonLogoImage */
    private $buttonLogo;

    /** @var IconLogoSliderImage */
    private $iconLogoSlider;

    /** @var BackgroundSliderImage */
    private $backgroundSlider;

    /**
     * @return ButtonLogoImage
     */
    public function getButtonLogo()
    {
        return $this->buttonLogo;
    }

    /**
     * @param ButtonLogoImage $buttonLogo
     *
     * @return $this
     */
    public function setButtonLogo($buttonLogo)
    {
        $this->buttonLogo = $buttonLogo;

        return $this;
    }

    /**
     * @return IconLogoSliderImage
     */
    public function getIconLogoSlider()
    {
        return $this->iconLogoSlider;
    }

    /**
     * @param IconLogoSliderImage $iconLogoSlider
     *
     * @return $this
     */
    public function setIconLogoSlider($iconLogoSlider)
    {
        $this->iconLogoSlider = $iconLogoSlider;

        return $this;
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
     *
     * @return $this
     */
    public function setBackgroundSlider($backgroundSlider)
    {
        $this->backgroundSlider = $backgroundSlider;

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        $logos = ['buttonLogo', 'iconLogoSlider', 'backgroundSlider'];
        $res = [];

        foreach ($logos as $logo) {
            $logoObj = $this->{'get' . ucfirst($logo)}();
            if (is_object($logoObj) && method_exists($logoObj, 'getName')) {
                $res[$logo] = (string)$logoObj->getName();
            }
        }

        return $res;
    }
}
