<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception;
use Psr\Http\Message\ResponseInterface;

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
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     */
    public function save(WidgetInterface $widget)
    {
        $response = $this->client->requestPost('widgets', $widget->toApi());
        $this->checkResponse($response, 201);
        $responseData = json_decode((string)$response->getBody(), true);

        return $this->widgetFactory->fromAPI($responseData);
    }

    /**
     * @param PaginationInterface $pagination
     * @return WidgetInterface[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     *
     */
    public function getList(PaginationInterface $pagination)
    {
        $query = [
            'limit' => $pagination->getLimit(),
            'offset' => $pagination->getOffset(),
        ];

        $response = $this->client->requestGet('widgets', $query);
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
     * @param int|array $statusCodeOk
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     */
    private function checkResponse(ResponseInterface $response, $statusCodeOk)
    {
        $codes = [];

        if (is_array($statusCodeOk)) {
            $codes = $statusCodeOk;
        } else {
            $codes[] = $statusCodeOk;
        }

        $statusCode = $response->getStatusCode();

        switch(true) {
            case(in_array($statusCode, $codes, true)):
                break;
            case ($statusCode === 400):
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\WidgetValidateException(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    $statusCode
                );
                break;
            case ($statusCode === 402):
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\ChangeOfPaidPropertiesException(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    $statusCode
                );
                break;
            default:
                throw new Exception\Exception('Error', $statusCode);
        }
    }
}
