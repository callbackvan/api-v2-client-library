<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images;

class ImagesFactory implements ImagesFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Images\Images
     */
    public function fromAPI(array $data)
    {
        $images = new Images\Images();

        foreach($data as $icon => $iconFile) {
            if (!is_string($icon)) {
                continue;
            }

            $setter = 'set' . ucfirst($icon);

            if (method_exists($images, $setter)) {
                $images->{$setter}($iconFile);
            }
        }

        return $images;
    }
}
