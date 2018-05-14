<?php

namespace CallbackHunterAPIv2\ValueObject;

/**
 * Объект для фильтрации виджетов при получении списка
 *
 * Class WidgetsFilter
 *
 * @package CallbackHunterAPIv2\ValueObject
 */
interface WidgetsFilterInterface
{
    public function toArray();
}
