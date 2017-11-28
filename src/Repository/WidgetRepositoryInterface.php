<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;

interface WidgetRepositoryInterface
{
    /**
     * @param WidgetInterface $widget
     * @return void
     */
    public function save(WidgetInterface $widget);

    /**
     * @param PaginationInterface $pagination
     * @return WidgetInterface[]
     */
    public function getList(PaginationInterface $pagination);
}
