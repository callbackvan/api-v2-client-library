<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Repository\CurrentProfileRepository;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CurrentProfileRepositoryTest
 *
 * @package Tests\Repository
 * @covers  \CallbackHunterAPIv2\Repository\CurrentProfileRepository
 */
class CurrentProfileRepositoryTest extends TestCase
{
    /** @var ClientInterface */
    private $client;

    /** @var ResponseInterface */
    private $response;

    /** @var CurrentProfileRepository $currentProfileRepository */
    private $currentProfileRepository;

    /** @var string */
    private $path;

    /**
     * @covers \CallbackHunterAPIv2\Repository\CurrentProfileRepository::get
     * @covers \CallbackHunterAPIv2\Repository\CurrentProfileRepository::checkResponse
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGet()
    {
        $responseData = [
            'id'          => 1234567,
            'name'        => 'Test',
            'email'       => 'aaa@bbb.com',
            'phone'       => '+78789798787',
            'language'    => 'ru',
            'account_ids' => [1, 2],
        ];

        $this->client->expects($this->once())
                     ->method('requestGet')
                     ->with($this->path)
                     ->willReturn($this->response);

        $this->response->expects($this->once())
                       ->method('getStatusCode')
                       ->willReturn(200);

        $this->response->expects($this->once())
                       ->method('getBody')
                       ->willReturn(json_encode($responseData));

        $this->assertSame(
            $responseData,
            $this->currentProfileRepository->get()
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\CurrentProfileRepository::get
     * @expectedException \CallbackHunterAPIv2\Exception\RepositoryException
     */
    public function testGetWithException()
    {
        $this->client->expects($this->once())
                     ->method('requestGet')
                     ->with($this->path)
                     ->willReturn($this->response);

        $this->response->expects($this->once())
                       ->method('getStatusCode')
                       ->willReturn(400);

        $this->response->expects($this->once())
                       ->method('getBody');

        $this->currentProfileRepository->get();
    }

    protected function setUp()
    {
        parent::setUp();

        $this->path = CurrentProfileRepository::PATH;

        $this->client = $this->createMock(ClientInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->currentProfileRepository = new CurrentProfileRepository(
            $this->client
        );
    }
}
