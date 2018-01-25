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
        array $invalidParams
    ) {
        parent::__construct($response, $message, 400);

        $this->invalidParams = $invalidParams;
    }

    public function getInvalidParams()
    {
        return $this->invalidParams;
    }
}
