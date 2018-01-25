<?php

namespace CallbackHunterAPIv2\Tests\Repository\Uploaded\Widget\Image;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Collection\UploadedCollectionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedCollectionFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\Factory\UploadedFactoryInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\ForUploadInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\PositionInterface;
use CallbackHunterAPIv2\Entity\Uploaded\Widget\Image\UploadedInterface;
use CallbackHunterAPIv2\Exception;
use CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository;
use CallbackHunterAPIv2\Type\FileForUploadInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class UploadedRepositoryTest extends TestCase
{
    /** @var UploadedRepository */
    private $repository;
    /** @var ClientInterface */
    private $client;
    /** @var UploadedCollectionFactoryInterface */
    private $uploadedCollectionFactory;
    /** @var UploadedFactoryInterface */
    private $uploadedFactory;

    /**
     * @covers       \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::__construct
     * @covers       \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::get
     * @dataProvider getListValidResponsesProvider
     *
     * @param integer $statusCode
     * @param array   $data
     */
    public function testGet($statusCode, array $data)
    {
        $widgetUid = 'test';

        $response = $this->createMock(ResponseInterface::class);
        $this->client
            ->expects($this->once())
            ->method('requestGet')
            ->with(sprintf('/uploaded/widgets/%s/images', $widgetUid))
            ->willReturn($response);

        $response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($data));


        $uploadedCollection = $this->createMock(
            UploadedCollectionInterface::class
        );

        $this->uploadedCollectionFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with($data)
            ->willReturn($uploadedCollection);

        $this->assertSame(
            $uploadedCollection,
            $this->repository->get($widgetUid)
        );
    }

    public function getListValidResponsesProvider()
    {
        return [
            [200, ['test' => 'data']],
            [201, []],
        ];
    }

    /**
     * @covers       \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::__construct
     * @covers       \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::get
     * @dataProvider exceptionsProvider
     *
     * @param integer $statusCode
     * @param string  $exceptionClass
     */
    public function testGetThrowsException($statusCode, $exceptionClass)
    {
        $widgetUid = 'test';

        $response = $this->createMock(ResponseInterface::class);
        $this->client
            ->expects($this->once())
            ->method('requestGet')
            ->with(sprintf('/uploaded/widgets/%s/images', $widgetUid))
            ->willReturn($response);

        $response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('');

        $this->expectException($exceptionClass);

        $this->repository->get($widgetUid);
    }

    /**
     * @covers       \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::upload
     * @dataProvider uploadedTypesProvider
     *
     * @param $type
     *
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpload($type)
    {
        $widgetUid = 'test';
        $file = $this->createMock(ForUploadInterface::class);
        $image = $this->createMock(FileForUploadInterface::class);
        $position = $this->createMock(PositionInterface::class);
        $positionValue = ['my position'];

        $file
            ->expects($this->once())
            ->method('getImage')
            ->willReturn($image);

        $file
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn($position);

        $position
            ->expects($this->once())
            ->method('toAPI')
            ->willReturn($positionValue);

        $response = $this->createMock(ResponseInterface::class);
        $this->client
            ->expects($this->once())
            ->method('uploadFile')
            ->with(
                sprintf(
                    '/uploaded/widgets/%s/images/%s/',
                    $widgetUid,
                    $type
                ),
                $image,
                ['position' => $positionValue]
            )
            ->willReturn($response);

        $response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(201);

        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('{"foo":"bar"}');

        $uploaded = $this->createMock(UploadedInterface::class);
        $this->uploadedFactory
            ->expects($this->once())
            ->method('fromAPI')
            ->with(['foo' => 'bar'])
            ->willReturn($uploaded);

        $this->assertSame(
            $uploaded,
            $this->repository->upload($widgetUid, $type, $file)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::upload
     * @expectedException \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function testUploadThrowsInvalidArgumentOnType()
    {
        $this->repository->upload(
            'another',
            'test',
            $this->createMock(ForUploadInterface::class)
        );
    }

    /**
     * @covers       \CallbackHunterAPIv2\Repository\Uploaded\Widget\Image\UploadedRepository::upload
     * @dataProvider exceptionsProvider
     *
     * @param integer $statusCode
     * @param string  $exceptionClass
     */
    public function testUploadThrowsResponseException(
        $statusCode,
        $exceptionClass
    ) {
        $file = $this->createMock(ForUploadInterface::class);
        $position = $this->createMock(PositionInterface::class);

        $file
            ->expects($this->once())
            ->method('getImage')
            ->willReturn($this->createMock(FileForUploadInterface::class));

        $file
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn($position);

        $response = $this->createMock(ResponseInterface::class);
        $this->client
            ->expects($this->once())
            ->method('uploadFile')
            ->willReturn($response);

        $response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $this->expectException($exceptionClass);

        $this->repository->upload(
            'another',
            UploadedCollectionInterface::TYPE_BACKGROUND_SLIDER,
            $file
        );
    }

    public function exceptionsProvider()
    {
        return [
            [400, Exception\DataValidateException::class],
            [402, Exception\ChangeOfPaidPropertiesException::class],
            [404, Exception\ResourceNotFoundException::class],
            [500, Exception\RepositoryException::class],
        ];
    }

    public function uploadedTypesProvider()
    {
        foreach (UploadedCollectionInterface::TYPES as $type) {
            yield [$type];
        }
    }

    protected function setUp()
    {
        parent::setUp();
        $this->repository = new UploadedRepository(
            $this->client = $this->createMock(ClientInterface::class),
            $this->uploadedCollectionFactory = $this->createMock(
                UploadedCollectionFactoryInterface::class
            ),
            $this->uploadedFactory = $this->createMock(
                UploadedFactoryInterface::class
            )
        );
    }
}
