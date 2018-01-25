<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidgetInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use Psr\Http\Message\ResponseInterface;

class DeprecatedWidgetRepository implements DeprecatedWidgetRepositoryInterface
{
    /** @var ClientInterface */
    private $client;

    /** @var WidgetFactoryInterface */
    private $widgetFactory;

    public function __construct(
        ClientInterface $client,
        WidgetFactoryInterface $widgetFactory
    ) {
        $this->client = $client;
        $this->widgetFactory = $widgetFactory;
    }

    /**
     * Получение списка виджетов
     *
     * @param PaginationInterface $pagination
     *
     * @return DeprecatedWidgetInterface[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\RepositoryException
     */
    public function getList(PaginationInterface $pagination)
    {
        $query = [
            'limit' => $pagination->getLimit(),
            'offset' => $pagination->getOffset(),
        ];

        $response = $this->client->requestGet('deprecated_widgets', $query);
        $this->checkResponse($response, [200, 204]);
        $responseData = json_decode((string)$response->getBody(), true);

        if (!isset($responseData['_embedded']['widgets'])) {
            return [];
        }

        $widgets = (array)$responseData['_embedded']['widgets'];
        $widgetsList = [];

        foreach ($widgets as $widgetData) {
            $widgetsList[] = $this->widgetFactory->fromAPI($widgetData);
        }

        return $widgetsList;
    }

    /**
     * @param ResponseInterface $response
     * @param array|int $statusCodeOk
     *
     * @throws Exception\RepositoryException
     *
     * @return true
     */
    private function checkResponse(ResponseInterface $response, $statusCodeOk)
    {
        $statusCode = $response->getStatusCode();

        if (in_array($statusCode, $statusCodeOk, true)) {
            return true;
        }

        $data = json_decode((string)$response->getBody(), true);
        throw new Exception\RepositoryException(
            $response,
            (isset($data['title']) ? $data['title'] : 'Error'),
            $statusCode
        );
    }
}
