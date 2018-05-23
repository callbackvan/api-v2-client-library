<?php

namespace CallbackHunterAPIv2\Repository;

interface TariffStatusRepositoryInterface
{
    /**
     * Информация о текущей тарификации
     *
     * @param $accountId int|string
     *
     * @return mixed
     */
    public function get($accountId);
}
