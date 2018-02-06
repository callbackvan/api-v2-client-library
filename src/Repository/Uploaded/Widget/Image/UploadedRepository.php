<?php

namespace CallbackHunterAPIv2\Repository\Uploaded\Widget\Image;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollectionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUploadInterface;
use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\Helper\ResponseHelper as RHelper;

class UploadedRepository
{
    /** @var ClientInterface */
    private $client;

    /** @var UploadedCollectionFactoryInterface */
    private $uploadedCollectionFactory;

    /** @var UploadedFactoryInterface */
    private $uploadedFactory;

    /**
     * UploadedRepository constructor.
     *
     * @param ClientInterface                    $clientFactory
     * @param UploadedCollectionFactoryInterface $uploadedCollectionFactory
     * @param UploadedFactoryInterface           $uploadedFactory
     */
    public function __construct(
        ClientInterface $clientFactory,
        UploadedCollectionFactoryInterface $uploadedCollectionFactory,
        UploadedFactoryInterface $uploadedFactory
    ) {
        $this->client = $clientFactory;
        $this->uploadedCollectionFactory = $uploadedCollectionFactory;
        $this->uploadedFactory = $uploadedFactory;
    }

    /**
     * @param $widgetUid
     *
     * @return UploadedCollectionInterface
     * @throws Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($widgetUid)
    {
        $response = $this->client->requestGet(
            sprintf('/uploaded/widgets/%s/images', $widgetUid)
        );

        if ($exception = RHelper::extractException($response, [200, 204])) {
            throw $exception;
        }


        return $this->uploadedCollectionFactory->fromAPI(
            RHelper::getBodyAsArray($response)
        );
    }

    /**
     * @param string             $widgetUid
     * @param string             $type
     * @param ForUploadInterface $file
     *
     * @return \CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload($widgetUid, $type, ForUploadInterface $file)
    {
        if (!in_array($type, UploadedCollectionInterface::TYPES, true)) {
            throw new Exception\InvalidArgumentException(
                'Invalid type: '.$type
            );
        }

        $response = $this->client->uploadFile(
            sprintf(
                '/uploaded/widgets/%s/images/%s/',
                $widgetUid,
                $type
            ),
            $file->getImage(),
            [
                'position' => $file->getPosition()->toAPI(),
                'sizes'    => $file->getSizes()->toAPI(),
            ]
        );

        if ($exception = RHelper::extractException($response, [201])) {
            throw $exception;
        }

        return $this->uploadedFactory->fromAPI(
            RHelper::getBodyAsArray($response)
        );
    }
}
