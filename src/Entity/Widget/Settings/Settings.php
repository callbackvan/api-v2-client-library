<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\Settings\Channels\Channels;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\Images;
use CallbackHunterAPIv2\Exception\InvalidArgumentException;
use SplObserver;

class Settings implements SettingsInterface, \SplSubject
{
    /** @var \SplObjectStorage */
    private $observers;

    /** @var string */
    private $backgroundTypeForSlider;

    /** @var Colors */
    private $colors;

    /** @var Position */
    private $position;

    /** @var Images */
    private $images;

    /** @var Channels */
    private $channels;

    /** @var Sizes */
    private $sizes;

    /** @var Texts */
    private $texts;

    /**
     * @param Colors   $colors
     * @param Position $position
     * @param Images   $images
     * @param Channels $channels
     * @param Sizes    $sizes
     * @param Texts    $texts
     */
    public function __construct(
        Colors $colors,
        Position $position,
        Images $images,
        Channels $channels,
        Sizes $sizes,
        Texts $texts
    ) {
        $this->observers = new \SplObjectStorage;
        $this->colors = $colors;
        $this->position = $position;
        $this->images = $images;
        $this->channels = $channels;
        $this->sizes = $sizes;
        $this->texts = $texts;
        $this->attach($images);
    }

    /**
     * @return Colors
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return Images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return Channels
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @return Sizes
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @return Texts
     */
    public function getTexts()
    {
        return $this->texts;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'backgroundTypeForSlider' => $this->backgroundTypeForSlider,
            'colors'                  => $this->colors->toAPI(),
            'position'                => $this->position->toAPI(),
            'images'                  => $this->images->toAPI(),
            'channels'                => $this->channels->toAPI(),
            'sizes'                   => $this->sizes->toAPI(),
            'texts'                   => $this->texts->toAPI(),
        ];
    }

    /**
     * @return string|null
     */
    public function getBackgroundTypeForSlider()
    {
        return $this->backgroundTypeForSlider;
    }

    /**
     * @param string $backgroundTypeForSlider
     *
     * @throws InvalidArgumentException
     */
    public function setBackgroundTypeForSlider($backgroundTypeForSlider)
    {
        $tmp = strtolower($backgroundTypeForSlider);

        if (!in_array($tmp, self::BACKGROUND_TYPES, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid background type: "%s"',
                    $backgroundTypeForSlider
                )
            );
        }

        $this->backgroundTypeForSlider = $tmp;
        $this->notify();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
