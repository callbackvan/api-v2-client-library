<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

class ActivateTrialNotAvailable extends RepositoryException
{
    public function __construct(
        ResponseInterface $response,
        $message,
        $code = 403
    ) {
        parent::__construct($response, $message, $code);
    }
}
