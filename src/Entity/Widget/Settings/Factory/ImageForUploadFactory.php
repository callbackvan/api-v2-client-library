<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\FileForUpload;
use CallbackHunterAPIv2\Type\FileForUploadInterface;
use \GuzzleHttp\Psr7;

class ImageForUploadFactory
{
    /**
     * @param string $pathToFile
     *
     * @return FileForUploadInterface|null
     */
    public function createFromPath($pathToFile)
    {
        if (!is_file($pathToFile) || !is_readable($pathToFile)) {
            return null;
        }

        $imageForUpload = new FileForUpload();
        $imageForUpload->setName(basename($pathToFile));

        $stream = $this->createStream($pathToFile);

        if (null !== $stream) {
            $imageForUpload->setStream($stream);
        }

        return $imageForUpload;
    }

    /**
     * @param string $pathToFile
     *
     * @return Psr7\Stream
     */
    protected function createStream($pathToFile)
    {
        $stream = null;

        try {
            $stream = Psr7\stream_for(fopen($pathToFile, 'rb'));
        } catch (\Exception $e) {
        }

        return $stream;
    }
}
