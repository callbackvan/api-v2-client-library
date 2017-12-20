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
    private $buttonSize;

    /**
     * Получить размер кнопки виджета
     *
     * @return int
     */
    public function getButtonSize()
    {
        return $this->buttonSize;
    }

    /**
     * Установить размер кнопки
     *
     * @param $buttonSize
     *
     * @return $this
     */
    public function setButtonSize($buttonSize)
    {
        $this->buttonSize = $buttonSize;

        return $this;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'buttonSize' => $this->getButtonSize(),
        ];
    }
}
