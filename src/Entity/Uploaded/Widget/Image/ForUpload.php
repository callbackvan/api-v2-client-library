<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Type\FileForUploadInterface;

class ForUpload implements ForUploadInterface
{
    /** @var FileForUploadInterface */
    private $image;

    /** @var PositionInterface */
    private $position;

    /** @var SizesInterface */
    private $sizes;

    /**
     * ForUpload constructor.
     *
     * @param FileForUploadInterface $image
     * @param PositionInterface      $position
     * @param SizesInterface         $sizes
     */
    public function __construct(
        FileForUploadInterface $image,
        PositionInterface $position,
        SizesInterface $sizes
    ) {
        $this->image = $image;
        $this->position = $position;
        $this->sizes = $sizes;
    }

    /**
     * @return FileForUploadInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return PositionInterface
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return SizesInterface
     */
    public function getSizes()
    {
        return $this->sizes;
    }
}
