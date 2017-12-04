<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

interface PositionInterface extends BaseEntityInterface
{
    /**
     * @return int
     */
    public function getX();

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setX($x);

    /**
     * @return int
     */
    public function getY();

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setY($x);
}
