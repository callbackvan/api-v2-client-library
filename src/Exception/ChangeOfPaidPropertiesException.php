<?php

namespace CallbackHunterAPIv2\Exception;

/**
 * Class ChangeOfPaidPropertiesException
 * @package CallbackHunterAPIv2\Exception
 */
class ChangeOfPaidPropertiesException extends Exception
{
    private $invalidParams;

    public function __construct($message, array $invalidParams)
    {
        parent::__construct($message, 402);

        $this->invalidParams = $invalidParams;
    }

    public function getInvalidParams()
    {
        return $this->invalidParams;
    }
}
