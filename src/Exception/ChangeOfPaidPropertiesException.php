<?php

namespace CallbackHunterAPIv2\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ChangeOfPaidPropertiesException
 * @package CallbackHunterAPIv2\Exception
 */
class ChangeOfPaidPropertiesException extends RepositoryException
{
    private $invalidParams;

    public function __construct(ResponseInterface $response, $message,
        array $invalidParams
    ) {
        parent::__construct($response, $message, 402);

        $this->invalidParams = $invalidParams;
    }

    public function getInvalidParams()
    {
        return $this->invalidParams;
    }
}
