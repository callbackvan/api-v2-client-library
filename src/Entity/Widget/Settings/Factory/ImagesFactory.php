<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Factory\BaseFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class ImagesFactory implements BaseFactoryInterface
{
    const NAMESPACE_FOR_IMG = '\CallbackHunterAPIv2\Entity\Widget\Settings\Images';

    /**
     * @param string $imageType
     *
     * @return Images\AbstractImage|null
     */
    public function createImageOfType($imageType)
    {
        $logoClass = self::NAMESPACE_FOR_IMG.'\\'.ucfirst($imageType).'Image';

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
        $images = [];

        foreach (Images\Images::TYPES as $iconType) {
            $logoObj = $this->createImageOfType($iconType);

            if ($logoObj instanceof Images\AbstractImage) {
                $APIName = lcfirst($iconType);
                if (isset($data[$APIName])) {
                    $logoObj->setName($data[$APIName]);
                }

                $images[] = $logoObj;
            }
        }

        return new Images\Images(...$images);
    }
}
