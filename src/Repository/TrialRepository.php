<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception\RepositoryException;
use CallbackHunterAPIv2\Helper\ResponseHelper;
use CallbackHunterAPIv2\ValueObject\ActivateTrialArguments;

class TrialRepository
{

    /** @var ClientInterface */
    private $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param int|string $accountUID
     * @param ActivateTrialArguments|null $trialArguments
     *
     * @return array
     *
     * @throws RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function activateTrial($accountUID, $trialArguments = null)
    {
        $response = $this->client->requestPost(
            'account/' . $accountUID . '/activate_trial',
            $trialArguments === null ?: $trialArguments->convertToArray()
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
