<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class WidgetValidateException
 *
 * @package CallbackHunterAPIv2\Exception
 */
class WidgetValidateException extends DataValidateException
{
    public function __construct(
        ResponseInterface $response,
        $message,
        array $invalidParams
    ) {
        parent::__construct($response, $message, $invalidParams);
    }
}
