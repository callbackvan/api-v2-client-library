<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception\RepositoryException;
use CallbackHunterAPIv2\Helper\ResponseHelper;

/**
 * Class WidgetPhoneRepository
 *
 * @package CallbackHunterAPIv2\Repository
 */
class WidgetPhoneRepository
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * WidgetPhoneRepository constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uid
     * @param string $phone
     *
     * @return array
     *
     * @throws RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addPhone($uid, $phone)
    {
        $response = $this->client->requestPost(
            '/widgets/' . $uid . '/phones',
            ['phone' => $phone]
        );

        $exception = ResponseHelper::extractException($response, [200]);
        if ($exception !== null) {
            throw $exception;
        }

        $responseData = ResponseHelper::getBodyAsArray($response);
        if (!$responseData) {
            throw new RepositoryException(
                $response,
                'Content is not json'
            );
        }

        return $responseData;
    }

    /**
     * @param string $widgetUID
     * @param string $phoneUID
     * @param string $phone
     *
     * @return array
     *
     * @throws RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatePhone($widgetUID, $phoneUID, $phone)
    {
        $response = $this->client->requestPost(
            '/widgets/' . $widgetUID . '/phones/' . $phoneUID,
            ['phone' => $phone]
        );

        $exception = ResponseHelper::extractException($response, [200]);
        if ($exception !== null) {
            throw $exception;
        }

        $responseData = ResponseHelper::getBodyAsArray($response);
        if (!$responseData) {
            throw new RepositoryException(
                $response,
                'Content is not json'
            );
        }

        return $responseData;
    }
}
