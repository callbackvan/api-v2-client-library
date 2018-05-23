<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Repository\TariffStatusRepository;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class TariffStatusRepositoryTest
 *
 * @package Tests\Repository
 * @covers  \CallbackHunterAPIv2\Repository\TariffStatusRepository
 */
class TariffStatusRepositoryTest extends TestCase
{
    /** @var ClientInterface */
    private $client;

    /** @var ResponseInterface */
    private $response;

    /** @var TariffStatusRepository $repository */
    private $repository;

    private $accountId = 1234567;
    private $path;

    /**
     * @covers \CallbackHunterAPIv2\Repository\TariffStatusRepository::get()
     * @covers \CallbackHunterAPIv2\Repository\TariffStatusRepository::checkResponse()
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGet()
    {
        $responseData = [
            'type'            => 'full',
            'trial_available' => false,
            'expire_date'     => '2020-10-10 10:10',
        ];

        $path = preg_replace('/{mixedId}/', $this->accountId, TariffStatusRepository::PATH);

        $this->client->expects($this->once())
                     ->method('requestGet')
                     ->with($path)
                     ->willReturn($this->response);

        $this->response->expects($this->once())
                       ->method('getStatusCode')
                       ->willReturn(200);

        $this->response->expects($this->once())
                       ->method('getBody')
                       ->willReturn(json_encode($responseData));

        $this->assertSame(
            $responseData,
            $this->repository->get($this->accountId)
        );
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\TariffStatusRepository::get()
     *
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

        $this->repository->get($this->accountId);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->path = preg_replace('/{mixedId}/', $this->accountId, TariffStatusRepository::PATH);

        $this->client = $this->createMock(ClientInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->repository = new TariffStatusRepository(
            $this->client
        );
    }
}
