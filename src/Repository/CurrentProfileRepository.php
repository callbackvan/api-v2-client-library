<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\Helper\ResponseHelper;
use Psr\Http\Message\ResponseInterface;

class CurrentProfileRepository implements CurrentProfileRepositoryInterface
{
    /** @var ClientInterface */
    private $client;

    const PATH = 'user/current/profile';

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Получение информации о текущем профиле
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\RepositoryException
     */
    public function get()
    {
        $response = $this->client->requestGet(self::PATH);
        $this->checkResponse($response, 200);

        return ResponseHelper::getBodyAsArray($response);
    }

    /**
     * @param ResponseInterface $response
     * @param array|int         $statusCodeOk
     *
     * @throws Exception\RepositoryException
     */
    private function checkResponse(ResponseInterface $response, $statusCodeOk)
    {
        $exception = ResponseHelper::extractException(
            $response,
            (array)$statusCodeOk
        );

        if ($exception === null) {
            return;
        }

        throw $exception;
    }
}
