<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception;

class WidgetRepository implements WidgetRepositoryInterface
{
    /** @var ClientInterface  */
    private $client;

    /** @var WidgetFactoryInterface  */
    private $widgetFactory;

    public function __construct(ClientInterface $client, WidgetFactoryInterface $widgetFactory)
    {
        $this->client = $client;
        $this->widgetFactory = $widgetFactory;
    }

    /**
     * @param WidgetInterface $widget
     * @return WidgetInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \CallbackHunterAPIv2\Exception\InvalidArgumentException
     * @throws \CallbackHunterAPIv2\Exception\ValidateException
     */
    public function save(WidgetInterface $widget)
    {
        $response = $this->client->requestPost('widgets', $widget->toApi());
        $responseData = json_decode((string)$response->getBody(), true);
        $this->checkResponse($responseData);

        return $this->widgetFactory->fromAPI($responseData);
    }

    /**
     * @param PaginationInterface $pagination
     * @return WidgetInterface[]
     */
    public function getList(PaginationInterface $pagination)
    {
        // todo
        return [];
    }

    private function checkResponse($responseData)
    {
        if (!isset($responseData['status'], $responseData['title'])) {
            throw new Exception\InvalidArgumentException('Error bad response data');
        }

        $statusCode = (int)$responseData['status'];
        $msg = $responseData['title'];

        switch($statusCode) {
            case (400):
                throw new Exception\ValidateException($msg, $statusCode);
                break;
            case (402):
                throw new Exception\ValidateException($msg, $statusCode);
                break;
            default:
                throw new Exception\Exception('Error');
        }
    }
}
