<?php

namespace CallbackHunterAPIv2\Repository\Variant\Widget\Image;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\BackgroundInterface;
use CallbackHunterAPIv2\Entity\Variant\Widget\Image\Factory\BackgroundFactoryInterface;

class BackgroundRepository
{
    /** @var ClientInterface */
    private $client;

    /** @var BackgroundFactoryInterface */
    private $backgroundFactory;

    public function __construct(
        ClientInterface $client,
        BackgroundFactoryInterface $backgroundFactory
    ) {
        $this->client = $client;
        $this->backgroundFactory = $backgroundFactory;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return BackgroundInterface|null
     */
    public function get()
    {
        $response = $this->client->requestGet('variants/widgets/images/backgrounds');
        $responseData = json_decode((string)$response->getBody(), true);

        if (!isset($responseData['_embedded']['backgroundSlider'])) {
            return null;
        }

        $backgrounds = (array)$responseData['_embedded'];

        return $this->backgroundFactory->fromAPI($backgrounds);
    }
}
