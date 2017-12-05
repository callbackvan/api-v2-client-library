<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage;
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

    /** @var WidgetInterface  */
    private $resultWidget;

    public function __construct(ClientInterface $client, WidgetFactoryInterface $widgetFactory)
    {
        $this->client = $client;
        $this->widgetFactory = $widgetFactory;
    }

    /**
     * Создание, изменение виджета
     *
     * @param WidgetInterface $widget
     * @return WidgetInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
     */
    public function save(WidgetInterface $widget)
    {
        $this->resultWidget = null;

        if ($widget->getUid()) {
            $response = $this->client->requestPost('widgets/' . $widget->getUid(), $widget->toApi());
        } else {
            $response = $this->client->requestPost('widgets', $widget->toApi());
        }
        $this->checkResponse($response, 201);
        $responseData = json_decode((string)$response->getBody(), true);

        $this->resultWidget = $this->widgetFactory->fromAPI($responseData);

        $images = $widget->getSettings()->getImages();
        $imagesForUpload = [
            'buttonLogo' => $images->getButtonLogo(),
            'iconLogoSlider' => $images->getIconLogoSlider(),
            'backgroundSlider' => $images->getBackgroundSlider(),
        ];

        $imageNames = $this->uploadImages($imagesForUpload);
        $this->setResultWidgetImageNames($imageNames);

        return $this->resultWidget;
    }

    /**
     * Получение списка виджетов
     *
     * @param PaginationInterface $pagination
     * @return WidgetInterface[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
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
     * Получение информации о виджете
     *
     * @param string $uid
     * @return WidgetInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
     */
    public function get($uid)
    {
        $response = $this->client->requestGet('widgets/' . $uid);
        $this->checkResponse($response, 200);
        $responseData = json_decode((string)$response->getBody(), true);

        return $this->widgetFactory->fromAPI($responseData);
    }

    /**
     * @param ResponseInterface $response
     * @param array|int $statusCodeOk
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
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
                    (isset($data['invalidParams']) ? (array)$data['invalidParams'] : [])
                );
                break;
            case ($statusCode === 402):
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\ChangeOfPaidPropertiesException(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    (isset($data['invalidParams']) ? (array)$data['invalidParams'] : [])
                );
                break;
            case ($statusCode === 404):
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\ResourceNotFoundException(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    $statusCode
                );
                break;
            default:
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\Exception(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    $statusCode
                );
        }
    }

    /**
     * @param array $images
     * @return array
     */
    private function uploadImages(array $images)
    {
        $path = sprintf('/widgets/%s/settings/images/', $this->resultWidget->getUid());
        $imageNames = [];

        /**
         * @var string $pathPart
         * @var AbstractImage $image
         */
        foreach ($images as $pathPart => $image) {
            $data = $image->getForUpload();

            if ($data === null) {
                continue;
            }

            $response = $this->client->uploadFile($path . $pathPart, $data);
            $this->checkResponse($response, 201);

            $responseData = json_decode((string)$response->getBody(), true);

            if (isset($responseData['name'], $responseData['value'])) {
                $imageNames[$responseData['name']] = $responseData['value'];
            }
        }

        return $imageNames;
    }

    /**
     * @param $imageNames
     */
    private function setResultWidgetImageNames($imageNames)
    {
        if (isset($imageNames['displayName'])) {
            $this->resultWidget->getSettings()
                ->getImages()
                ->getButtonLogo()
                ->setName($imageNames['displayName']);
        }

        if (isset($imageNames['iconLogoSlider'])) {
            $this->resultWidget->getSettings()
                ->getImages()
                ->getIconLogoSlider()
                ->setName($imageNames['iconLogoSlider']);
        }

        if (isset($imageNames['backgroundSlider'])) {
            $this->resultWidget->getSettings()
                ->getImages()
                ->getBackgroundSlider()
                ->setName($imageNames['backgroundSlider']);
        }
    }
}
