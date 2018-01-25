<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use CallbackHunterAPIv2\Exception\InvalidArgumentException;

class UploadedCollection implements UploadedCollectionInterface
{
    private $data;

    /**
     * UploadedCollection constructor.
     */
    public function __construct()
    {
        $this->data = [];
        foreach (self::TYPES as $type) {
            $this->data[$type] = [];
        }
    }

    /**
     * @return UploadedInterface[]
     */
    public function getButtonLogo()
    {
        return $this->data[self::TYPE_BUTTON_LOGO];
    }

    /**
     * @return UploadedInterface[]
     */
    public function getIconLogoSlider()
    {
        return $this->data[self::TYPE_ICON_LOGO_SLIDER];
    }

    /**
     * @return UploadedInterface[]
     */
    public function getBackgroundSlider()
    {
        return $this->data[self::TYPE_BACKGROUND_SLIDER];
    }

    /**
     * @param string            $type
     * @param UploadedInterface $uploaded
     *
     * @throws InvalidArgumentException
     */
    public function add($type, UploadedInterface $uploaded)
    {
        if (!in_array($type, self::TYPES, true)) {
            throw new InvalidArgumentException('Invalid type: '.$type);
        }

        $this->data[$type][] = $uploaded;
    }
}
