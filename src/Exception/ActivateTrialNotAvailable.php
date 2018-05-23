<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

class ActivateTrialNotAvailable extends RepositoryException
{
    private $invalidParams;

    public function __construct(
        ResponseInterface $response,
        $message,
        array $invalidParams,
        $code = 403
    ) {
        parent::__construct($response, $message, $code);

        $this->invalidParams = $invalidParams;
    }

    public function getInvalidParams()
    {
        return $this->invalidParams;
    }
}
