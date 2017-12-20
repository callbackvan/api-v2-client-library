<?php

declare(strict_types = 1);

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

interface SizesInterface
{
    /**
     * Получить размер кнопки виджета
     *
     * @return int
     */
    public function getButtonSize();
}
