<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Uploaded;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use CallbackHunterAPIv2\Exception\InvalidArgumentException;

class UploadedFactory implements UploadedFactoryInterface
{
    /** @var PositionFactoryInterface */
    private $positionFactory;
    /** @var SizesFactoryInterface */
    private $sizesFactory;

    /**
     * UploadedFactory constructor.
     *
     * @param PositionFactoryInterface $positionFactory
     * @param SizesFactoryInterface    $sizesFactory
     */
    public function __construct(
        PositionFactoryInterface $positionFactory,
        SizesFactoryInterface $sizesFactory
    )
    {
        $this->positionFactory = $positionFactory;
        $this->sizesFactory = $sizesFactory;
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
            $data['position']['y'],
            $data['sizes']['width'],
            $data['sizes']['height']
        );

        if (!$isValidData) {
            throw new InvalidArgumentException('Invalid data');
        }

        $url = $data['_links']['self']['href'];

        return new Uploaded(
            $url,
            $this->positionFactory->fromAPI($data['position']),
            $this->sizesFactory->fromAPI($data['sizes'])
        );
    }
}
