<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class Images
{
    /** @var string */
    private $buttonLogo = '';

    /** @var string */
    private $iconLogoSlider = '';

    /** @var string */
    private $backgroundSlider = '';

    /**
     * @return string
     */
    public function getButtonLogo()
    {
        return $this->buttonLogo;
    }

    /**
     * @param string $buttonLogo
     *
     * @return $this
     */
    public function setButtonLogo($buttonLogo)
    {
        $this->buttonLogo = $buttonLogo;

        return $this;
    }

    /**
     * @return string
     */
    public function getIconLogoSlider()
    {
        return $this->iconLogoSlider;
    }

    /**
     * @param string $iconLogoSlider
     *
     * @return $this
     */
    public function setIconLogoSlider($iconLogoSlider)
    {
        $this->iconLogoSlider = $iconLogoSlider;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundSlider()
    {
        return $this->backgroundSlider;
    }

    /**
     * @param string $backgroundSlider
     *
     * @return $this
     */
    public function setBackgroundSlider($backgroundSlider)
    {
        $this->backgroundSlider = $backgroundSlider;

        return $this;
    }
}
