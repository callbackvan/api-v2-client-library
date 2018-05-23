<?php

namespace CallbackHunterAPIv2\Helper;

use CallbackHunterAPIv2\Exception;
use Psr\Http\Message\ResponseInterface;

class ResponseHelper
{
    /**
     * @param ResponseInterface $response
     * @param array             $validStatuses
     *
     * @return Exception\RepositoryException|null
     */
    public static function extractException(
        ResponseInterface $response,
        array $validStatuses
    ) {
        $statusCode = $response->getStatusCode();
        if (in_array($statusCode, $validStatuses, true)) {
            return null;
        }

        $data = self::getBodyAsArray($response);
        $title = isset($data['title']) ? $data['title'] : 'Error';
        $invalidParams = [];
        if (isset($data['invalidParams'])) {
            $invalidParams = (array)$data['invalidParams'];
        }

        switch ($statusCode) {
            case 400:
                $exception = new Exception\DataValidateException(
                    $response,
                    $title,
                    $invalidParams
                );
                break;
            case 402:
                $exception = new Exception\ChangeOfPaidPropertiesException(
                    $response,
                    $title,
                    $invalidParams
                );
                break;
            case 403:
                $exception = new Exception\ActivateTrialNotAvailable(
                    $response,
                    $title,
                    $invalidParams
                );
                break;
            case 404:
                $exception = new Exception\ResourceNotFoundException(
                    $response,
                    $title,
                    $statusCode
                );
                break;
            default:
                $exception = new Exception\RepositoryException(
                    $response,
                    $title,
                    $statusCode
                );
        }

        return $exception;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    public static function getBodyAsArray(ResponseInterface $response)
    {
        $result = json_decode((string)$response->getBody(), true);

        return $result ?: [];
    }
}
