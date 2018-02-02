<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class DataValidateException
 *
 * @package CallbackHunterAPIv2\Exception
 */
class DataValidateException extends RepositoryException
{
    private $invalidParams;

    public function __construct(
        ResponseInterface $response,
        $message,
        array $invalidParams,
        $code = 400
    ) {
        parent::__construct($response, $message, $code);

        $this->invalidParams = $invalidParams;
    }

    public function getInvalidParams()
    {
        return $this->invalidParams;
    }
}
