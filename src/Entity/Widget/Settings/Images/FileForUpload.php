<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Type\FileForUploadInterface;
use Psr\Http\Message\StreamInterface;

class FileForUpload implements FileForUploadInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var StreamInterface
     */
    private $stream;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * @param StreamInterface $stream
     *
     * @return $this
     */
    public function setStream($stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
