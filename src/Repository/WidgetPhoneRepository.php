<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Phone\PhoneInterface;
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
     * Добавление или обновление телефона виджета
     *
     * @param string         $widgetUID
     * @param PhoneInterface $phone
     *
     * @return array
     *
     * @throws RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function save($widgetUID, PhoneInterface $phone)
    {
        if ($phone->getId()) {
            $response = $this->client->requestPost(
                '/widgets/' . $widgetUID . '/phones/' . $phone->getId(),
                ['phone' => $phone->getPhone()]
            );
        } else {
            $response = $this->client->requestPost(
                '/widgets/' . $widgetUID . '/phones',
                ['phone' => $phone->getPhone()]
            );
        }

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
