<?php

namespace CallbackHunterAPIv2\Tests\Repository;

use CallbackHunterAPIv2\ClientInterface;
use CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable;
use CallbackHunterAPIv2\Helper\ResponseHelper;
use CallbackHunterAPIv2\Repository\TrialRepository;
use CallbackHunterAPIv2\ValueObject\ActivateTrialArguments;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class TrialRepositoryTest extends TestCase
{
    /** @var ClientInterface */
    private $client;

    /** @var ResponseInterface */
    private $response;

    /** @var ResponseHelper */
    private $responseHelper;

    /** @var TrialRepository */
    private $trialRepository;

    /** @var array  */
    private $responseData = [
        'title' => 'foo',
        'expire_date' => 'bar',
    ];

    /** @var ActivateTrialArguments */
    private $trialArguments;

    /**
     * @covers \CallbackHunterAPIv2\Repository\TrialRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\TrialRepository::activateTrial
     *
     * @dataProvider activateTrialDataProvider
     *
     * @param $accountUID
     * @param $arguments
     *
     * @throws \CallbackHunterAPIv2\Exception\RepositoryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testActivateTrial($accountUID, $arguments)
    {
        $this->trialArguments
            ->expects($this->once())
            ->method('convertToArray')
            ->willReturn($arguments);

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                'account/' . $accountUID . '/activate_trial',
                $arguments
            )
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($this->responseData));

        $this->assertEquals($this->responseData, $this->trialRepository->activateTrial($accountUID, $this->trialArguments));
    }

    public function activateTrialDataProvider()
    {
        return [
            [
                'foo-bar-baz',
                ['phone' => '123'],
            ],
        ];
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\TrialRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\TrialRepository::activateTrial
     *
     * @expectedException \CallbackHunterAPIv2\Exception\ActivateTrialNotAvailable
     * @expectedExceptionMessage Активация тестового периода не доступна.
     */
    public function testActivateTrialThrowsActivateTrialNotAvailable()
    {
        $accountUID = 'foo-bar-baz';
        $path = 'account/' . $accountUID . '/activate_trial';
        $arguments = ['phone' => '123'];

        $errorResponseBody = [
            'type'          => 'https://developers.callbackhunter.com/#errorForbidden',
            'title'         => 'Активация тестового периода не доступна.',
            'status'        => 403,
            'detail'        =>
                'Проверьте, что у аккаунта ещё ни разу не ' .
                'был активирован тестовый период, а ' .
                'также не подключён платный тариф. ' .
                'Для проверки, зайдите к себе в личный кабинет ' .
                '(https://callbackhunter.com/cabinet/), ' .
                'чтобы убедится в этом. ',
        ];

        $this->trialArguments
            ->expects($this->once())
            ->method('convertToArray')
            ->willReturn($arguments);

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with($path, $arguments)
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(json_encode($errorResponseBody));

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(403);

        $this->trialRepository->activateTrial($accountUID, $this->trialArguments);
    }

    /**
     * @covers \CallbackHunterAPIv2\Repository\TrialRepository::__construct
     * @covers \CallbackHunterAPIv2\Repository\TrialRepository::activateTrial
     *
     * @expectedException \CallbackHunterAPIv2\Exception\RepositoryException
     * @expectedExceptionMessage Content is not json
     */
    public function testActivateTrialThrowsRepositoryException()
    {
        $accountUID = 'foo-bar-baz';
        $arguments = ['phone' => '123'];

        $this->trialArguments
            ->expects($this->once())
            ->method('convertToArray')
            ->willReturn($arguments);

        $this->client
            ->expects($this->once())
            ->method('requestPost')
            ->with(
                'account/' . $accountUID . '/activate_trial',
                $arguments
            )
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('not json');

        $this->trialRepository->activateTrial($accountUID, $this->trialArguments);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->createMock(ClientInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->responseHelper = $this->createMock(ResponseHelper::class);
        $this->trialArguments = $this->createMock(ActivateTrialArguments::class);

        $this->trialRepository = new TrialRepository(
            $this->client
        );
    }
}
