<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Factory\BaseFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Sizes;

class SizesFactory implements BaseFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Sizes
     */
    public function fromAPI(array $data)
    {
        $sizes = new Sizes();

        if (isset($data['buttonSize'])) {
            $sizes->setButtonSize($data['buttonSize']);
        }

        return $sizes;
    }
}
