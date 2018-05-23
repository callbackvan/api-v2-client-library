<?php

namespace CallbackHunterAPIv2\Repository;

interface CurrentProfileRepositoryInterface
{
    /**
     * Информация о текущем профиле
     *
     * @return array
     */
    public function get();
}
