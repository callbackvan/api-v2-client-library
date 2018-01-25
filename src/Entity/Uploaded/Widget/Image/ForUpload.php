<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Type\FileForUploadInterface;

class ForUpload implements ForUploadInterface
{
    /** @var FileForUploadInterface */
    private $image;

    /** @var PositionInterface */
    private $position;

    /**
     * ForUpload constructor.
     *
     * @param FileForUploadInterface $image
     * @param PositionInterface      $position
     */
    public function __construct(
        FileForUploadInterface $image,
        PositionInterface $position
    ) {
        $this->image = $image;
        $this->position = $position;
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
}
