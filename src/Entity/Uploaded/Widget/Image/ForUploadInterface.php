<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

use CallbackHunterAPIv2\Type\FileForUploadInterface;

interface ForUploadInterface
{
    /**
     * @return FileForUploadInterface
     */
    public function getImage();

    /**
     * @return PositionInterface
     */
    public function getPosition();
}
