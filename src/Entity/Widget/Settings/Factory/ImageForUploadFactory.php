<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload;
use CallbackHunterAPIv2\Type\FileForUploadInterface;
use GuzzleHttp\Psr7;

class ImageForUploadFactory
{
    /**
     * @param string $pathToFile
     *
     * @return FileForUploadInterface|null
     * @throws \InvalidArgumentException
     */
    public function createFromPath($pathToFile)
    {
        $imageForUpload = new FileForUpload();

        $stream = Psr7\stream_for(fopen($pathToFile, 'rb'));
        $imageForUpload->setName(basename($pathToFile));

        if (null !== $stream) {
            $imageForUpload->setStream($stream);
        }

        return $imageForUpload;
    }
}
