<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images;
use \GuzzleHttp\Psr7;

class ImagesFactory implements ImagesFactoryInterface
{
    const NAMESPACE_FOR_IMG = '\CallbackHunterAPIv2\Entity\Widget\Settings\Images';

    /**
     * @param string $pathToFile
     *
     * @return Psr7\Stream
     */
    protected function createStream($pathToFile)
    {
        $stream = null;

        if (!is_file($pathToFile) || !is_readable($pathToFile)) {
            return $stream;
        }

        try {
            $stream = Psr7\stream_for(fopen($pathToFile, 'rb'));
        } catch (\Exception $e) {
        }

        return $stream;
    }

    /**
     * @param string $imageType buttonLogo|iconLogoSlider|backgroundSlider
     * @param string $pathToFile
     *
     * @return Images\AbstractImage|null
     */
    public function createImageOfTypeAndPath($imageType, $pathToFile)
    {
        $imgObj = $this->createImageOfType($imageType);

        if (null === $imgObj) {
            return null;
        }

        $fileStream = $this->createStream($pathToFile);

        if (null !== $fileStream) {
            $imgObj->setForUpload($fileStream);
        }

        return $imgObj;
    }

    /**
     * @param string $imageType
     *
     * @return Images\AbstractImage|null
     */
    public function createImageOfType($imageType)
    {
        $logoClass = self::NAMESPACE_FOR_IMG . '\\' . ucfirst($imageType). 'Image';

        $logoObj = null;

        if (class_exists($logoClass)
            && is_subclass_of($logoClass, Images\AbstractImage::class)
        ) {
            $logoObj = new $logoClass();
        }

        return $logoObj;
    }

    /**
     * @param array $data
     *
     * @return Images\Images
     */
    public function fromAPI(array $data)
    {
        $images = new Images\Images();

        foreach($data as $iconType => $iconFile) {
            if (!is_string($iconType)) {
                continue;
            }

            $logoObj = $this->createImageOfType($iconType);

            if (null === $logoObj) {
                continue;
            }

            if (method_exists($logoObj, 'setName')) {
                $logoObj->setName($iconFile);
            }

            $setter = 'set' . ucfirst($iconType);
            if (method_exists($images, $setter)) {
                $images->{$setter}($logoObj);
            }
        }

        return $images;
    }
}
