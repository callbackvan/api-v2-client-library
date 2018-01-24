<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidgetInterface;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;

interface DeprecatedWidgetRepositoryInterface
{
    /**
     * @param PaginationInterface $pagination
     *
     * @return DeprecatedWidgetInterface[]
     */
    public function getList(PaginationInterface $pagination);
}
