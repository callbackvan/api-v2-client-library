<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

class RepositoryException extends Exception
{
    private $response;

    public function __construct(ResponseInterface $response, $message = '',
        $code = 0
    ) {
        parent::__construct($message, $code);
        $this->response = $response;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
