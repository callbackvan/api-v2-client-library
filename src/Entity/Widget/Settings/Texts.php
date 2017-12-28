<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

class Texts implements TextsInterface
{
    /** @var string */
    private $sliderCallbackButton;

    /** @var string */
    private $sliderTitle;

    /**
     * Получить текст надписи на кнопке звонка
     *
     * @return string
     */
    public function getSliderCallbackButton()
    {
        return $this->sliderCallbackButton;
    }

    /**
     * Установить текст надписи на кнопке звонка
     *
     * @param $text
     */
    public function setSliderCallbackButton($text)
    {
        $this->sliderCallbackButton = $text;
    }

    /**
     * Получить текст подсказки
     *
     * @return string
     */
    public function getSliderTitle()
    {
        return $this->sliderTitle;
    }

    /**
     * Установить текст подсказки
     *
     * @param $text
     */
    public function setSliderTitle($text)
    {
        $this->sliderTitle = $text;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'sliderCallbackButton' => $this->getSliderCallbackButton(),
            'sliderTitle' => $this->getSliderTitle(),
        ];
    }
}
