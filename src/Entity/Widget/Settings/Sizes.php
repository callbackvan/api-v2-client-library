<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

use CallbackHunterAPIv2\Entity\Widget\BaseEntityInterface;

class Sizes implements SizesInterface, BaseEntityInterface
{
    /**
     * Размер кнопки виджета
     *
     * @var int
     */
    private $button;

    /**
     * Получить размер кнопки виджета
     *
     * @return int|null
     */
    public function getButton()
    {
        return $this->button;
    }

    /**
     * Установить размер кнопки
     *
     * @param int $button
     *
     * @return $this
     */
    public function setButton($button)
    {
        $this->button = (int)$button;

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'button' => $this->getButton(),
        ];
    }
}
