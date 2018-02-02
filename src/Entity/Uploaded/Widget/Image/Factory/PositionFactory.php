<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Position;

class PositionFactory implements PositionFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Position
     */
    public function fromAPI(array $data)
    {
        $position = new Position();

        if (isset($data['x'])) {
            $position->setX($data['x']);
        }

        if (isset($data['y'])) {
            $position->setY($data['y']);
        }

        return $position;
    }
}
