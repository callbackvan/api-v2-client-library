<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use CallbackHunterAPIv2\Exception\InvalidArgumentException;

class UploadedFactory implements UploadedFactoryInterface
{
    /** @var PositionFactoryInterface */
    private $positionFactory;

    /**
     * UploadedFactory constructor.
     *
     * @param PositionFactoryInterface $positionFactory
     */
    public function __construct(PositionFactoryInterface $positionFactory)
    {
        $this->positionFactory = $positionFactory;
    }

    /**
     * @param array $data
     *
     * @return UploadedInterface
     * @throws InvalidArgumentException
     */
    public function fromAPI(array $data)
    {
        $isValidData = isset(
            $data['_links']['self']['href'],
            $data['position']['x'],
            $data['position']['y']
        );

        if (!$isValidData) {
            throw new InvalidArgumentException('Invalid data');
        }

        $url = $data['_links']['self']['href'];

        return new Uploaded(
            $url,
            $this->positionFactory->fromAPI($data['position'])
        );
    }
}
