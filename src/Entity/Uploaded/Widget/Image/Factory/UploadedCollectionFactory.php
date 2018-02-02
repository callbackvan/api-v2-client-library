<?php

namespace CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory;

use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollection;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollectionInterface;

class UploadedCollectionFactory implements UploadedCollectionFactoryInterface
{
    /**
     * @var UploadedFactoryInterface
     */
    private $uploadedFactory;

    /**
     * UploadedCollectionFactory constructor.
     *
     * @param UploadedFactoryInterface $uploadedFactory
     */
    public function __construct(UploadedFactoryInterface $uploadedFactory)
    {
        $this->uploadedFactory = $uploadedFactory;
    }

    /**
     * @param array $data
     *
     * @return UploadedCollectionInterface
     * @throws \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function fromAPI(array $data)
    {
        $result = new UploadedCollection;

        foreach (UploadedCollection::TYPES as $type) {
            if (isset($data['_embedded'][$type])) {
                foreach ((array)$data['_embedded'][$type] as $image) {
                    $result->add(
                        $type,
                        $this->uploadedFactory->fromAPI($image)
                    );
                }
            }
        }

        return $result;
    }
}
