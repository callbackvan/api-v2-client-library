<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image;

interface UploadedInterface
{
    /**
     * @return string|null
     */
    public function getURL();

    /**
     * @return PositionInterface
     */
    public function getPosition();
}
