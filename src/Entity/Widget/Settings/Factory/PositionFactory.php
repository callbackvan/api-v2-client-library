<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings;

class PositionFactory
{
    /**
     * @param array $data
     *
     * @return Settings\Position
     */
    public function fromAPI(array $data)
    {
        $position = new Settings\Position();

        if (isset($data['x'])) {
            $position->setX($data['x']);
        }

        if (isset($data['y'])) {
            $position->setY($data['y']);
        }

        if (isset($data['isFixedButton'])) {
            $position->setFixedButton($data['isFixedButton']);
        }

        return $position;
    }
}
