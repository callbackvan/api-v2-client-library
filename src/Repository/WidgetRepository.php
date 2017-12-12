<?php

namespace CallbackHunterAPIv2\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Widget\Factory\WidgetFactoryInterface;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\AbstractImage;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;
use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\ValueObject\PaginationInterface;
use Psr\Http\Message\ResponseInterface;

class WidgetRepository implements WidgetRepositoryInterface
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
     * Создание, изменение виджета
     *
     * @param WidgetInterface $widget
     *
     * @return WidgetInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
     */
    public function save(WidgetInterface $widget)
    {
        $data = $this->removeNullValues($widget->toAPI());

        if ($widget->getUid()) {
            $response = $this->client->requestPost(
                'widgets/'.$widget->getUid(),
                $data
            );
        } else {
            $response = $this->client->requestPost('widgets', $data);
        }
        $this->checkResponse($response, 201);
        $responseData = json_decode((string)$response->getBody(), true);

        $saved = $this->widgetFactory->fromAPI($responseData);

        $images = $widget->getSettings()->getImages();
        $imagesForUpload = [
            'buttonLogo'       => $images->getButtonLogo(),
            'iconLogoSlider'   => $images->getIconLogoSlider(),
            'backgroundSlider' => $images->getBackgroundSlider(),
        ];

        $imageNames = $this->uploadImages($saved, $imagesForUpload);
        $this->setResultWidgetImageNames($imageNames, $saved);

        return $saved;
    }

    /**
     * Получение списка виджетов
     *
     * @param PaginationInterface $pagination
     *
     * @return WidgetInterface[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
     */
    public function getList(PaginationInterface $pagination)
    {
        $query = [
            'limit'  => $pagination->getLimit(),
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
     *
     * @return WidgetInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\WidgetValidateException
     * @throws Exception\ResourceNotFoundException
     */
    public function get($uid)
    {
        $response = $this->client->requestGet('widgets/'.$uid);
        $this->checkResponse($response, 200);
        $responseData = json_decode((string)$response->getBody(), true);

        return $this->widgetFactory->fromAPI($responseData);
    }

    /**
     * @param ResponseInterface $response
     * @param array|int         $statusCodeOk
     *
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

        switch (true) {
            case (in_array($statusCode, $codes, true)):
                break;
            case ($statusCode === 400):
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\WidgetValidateException(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    (isset($data['invalidParams'])
                        ? (array)$data['invalidParams'] : [])
                );
                break;
            case ($statusCode === 402):
                $data = json_decode((string)$response->getBody(), true);
                throw new Exception\ChangeOfPaidPropertiesException(
                    (isset($data['title']) ? $data['title'] : 'Error'),
                    (isset($data['invalidParams'])
                        ? (array)$data['invalidParams'] : [])
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
     * @param WidgetInterface $widget
     * @param array           $images
     *
     * @return array
     * @throws Exception\ChangeOfPaidPropertiesException
     * @throws Exception\Exception
     * @throws Exception\ResourceNotFoundException
     * @throws Exception\WidgetValidateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function uploadImages(WidgetInterface $widget, array $images)
    {
        $path = sprintf(
            '/widgets/%s/settings/images/',
            $widget->getUid()
        );
        $imageNames = [];

        /**
         * @var string        $pathPart
         * @var AbstractImage $image
         */
        foreach ($images as $pathPart => $image) {
            $data = $image->getForUpload();

            if ($data === null) {
                continue;
            }

            $response = $this->client->uploadFile($path.$pathPart, $data);
            $this->checkResponse($response, 201);

            $responseData = json_decode((string)$response->getBody(), true);

            if (isset($responseData['name'], $responseData['value'])) {
                $imageNames[$responseData['name']] = $responseData['value'];
            }
        }

        return $imageNames;
    }

    /**
     * @param array           $imageNames
     * @param WidgetInterface $widget
     */
    private function setResultWidgetImageNames(
        $imageNames,
        WidgetInterface $widget
    ) {
        if (isset($imageNames['displayName'])) {
            $widget->getSettings()
                ->getImages()
                ->getButtonLogo()
                ->setName($imageNames['displayName']);
        }

        if (isset($imageNames['iconLogoSlider'])) {
            $widget->getSettings()
                ->getImages()
                ->getIconLogoSlider()
                ->setName($imageNames['iconLogoSlider']);
        }

        if (isset($imageNames['backgroundSlider'])) {
            $widget->getSettings()
                ->getImages()
                ->getBackgroundSlider()
                ->setName($imageNames['backgroundSlider']);
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function removeNullValues(array $data)
    {
        foreach ($data as $key => $value) {
            if ($value === null) {
                unset($data[$key]);
                continue;
            }

            if (!is_array($value)) {
                continue;
            }


            $value = $this->removeNullValues($value);
            if (!count($value)) {
                unset($data[$key]);
                continue;
            }

            $data[$key] = $value;
        }

        return $data;
    }
}
