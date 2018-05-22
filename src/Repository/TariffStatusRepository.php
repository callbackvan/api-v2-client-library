<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\Helper\ResponseHelper;
use Psr\Http\Message\ResponseInterface;

class TariffStatusRepository implements TariffStatusRepositoryInterface
{
    /** @var ClientInterface */
    private $client;

    const PATH = '/account/{mixedId}/tariff/status/';

    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    /**
     * Информация о текущей тарификации
     *
     * @param $accountId int|string id или uuid аккаунта
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\RepositoryException
     */
    public function get($accountId)
    {
        $path = preg_replace('/{mixedId}/', $accountId,self::PATH);

        $response = $this->client->requestGet($path);
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

