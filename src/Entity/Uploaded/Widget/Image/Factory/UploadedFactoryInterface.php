<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use CallbackHunterAPIv2\Exception\InvalidArgumentException;

interface UploadedFactoryInterface
{
    /**
     * @param array $data
     *
     * @return UploadedInterface
     * @throws InvalidArgumentException
     */
    public function fromAPI(array $data);
}
