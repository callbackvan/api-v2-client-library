<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ChangeOfPaidPropertiesException
 *
 * @package CallbackHunterAPIv2\Exception
 */
class ChangeOfPaidPropertiesException extends DataValidateException
{
    public function __construct(
        ResponseInterface $response,
        $message,
        array $invalidParams
    ) {
        parent::__construct($response, $message, $invalidParams, 402);
    }
}
