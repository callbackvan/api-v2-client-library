<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollectionInterface;

interface UploadedCollectionFactoryInterface
{
    /**
     * @param array $data
     *
     * @return UploadedCollectionInterface
     */
    public function fromAPI(array $data);
}
