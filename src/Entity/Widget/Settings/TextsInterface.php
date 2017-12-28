<?php

namespace CallbackHunterAPIv2\Entity\Widget\Settings;

interface TextsInterface
{
    /**
     * Получить текст надписи на кнопке звонка
     *
     * @return string
     */
    public function getSliderCallbackButton();

    /**
     * Установить текст надписи на кнопке звонка
     *
     * @param $text
     */
    public function setSliderCallbackButton($text);

    /**
     * Получить текст подсказки
     *
     * @return string
     */
    public function getSliderTitle();

    /**
     * Установить текст подсказки
     *
     * @param $text
     */
    public function setSliderTitle($text);
}
