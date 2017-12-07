<?php

namespace CallbackHunterAPIv2\Exception;

/**
 * Class WidgetValidateException
 * @package CallbackHunterAPIv2\Exception
 */
class WidgetValidateException extends Exception
{
    private $invalidParams;

    public function __construct($message, array $invalidParams)
    {
        parent::__construct($message, 400);

        $this->invalidParams = $invalidParams;
    }

    public function getInvalidParams()
    {
        return $this->invalidParams;
    }
}
