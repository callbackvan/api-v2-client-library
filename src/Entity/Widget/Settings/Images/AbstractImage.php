<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Images;

use CallbackHunterAPIv2\Type\FileForUploadInterface;

abstract class AbstractImage
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $name;

    /**
     * @var FileForUploadInterface
     */
    private $imageForUpload;

    /**
     * AbstractImage constructor.
     *
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getURL()
    {
        return $this->name ? $this->baseUrl.$this->name : '';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getForUpload()
    {
        return $this->imageForUpload?:null;
    }

    public function setForUpload(FileForUploadInterface $image)
    {
        $this->imageForUpload = $image;
    }
}
