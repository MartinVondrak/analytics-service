<?php


namespace MartinVondrak\AnalyticsService;


use MartinVondrak\AnalyticsService\Entity\CustomerAction;
use MartinVondrak\AnalyticsService\Http\HttpException;
use MartinVondrak\AnalyticsService\Http\Request;
use MartinVondrak\AnalyticsService\Http\Response;
use MartinVondrak\AnalyticsService\Resolver\CustomerActionResolver;
use MartinVondrak\AnalyticsService\Service\AuthenticatorService;
use MartinVondrak\AnalyticsService\Service\CustomerParsingService;
use MartinVondrak\AnalyticsService\Service\SerializationService;
use MartinVondrak\AnalyticsService\Service\StatisticRecordService;
use MartinVondrak\AnalyticsService\Validator\RequestValidator;

class Server
{
    /** @var AuthenticatorService */
    private $authenticatorService;

    /** @var RequestValidator */
    private $requestValidator;

    /** @var CustomerParsingService */
    private $customerParsingService;

    /** @var CustomerActionResolver */
    private $customerActionResolver;

    /** @var StatisticRecordService */
    private $statisticRecordService;

    /** @var SerializationService */
    private $serializationService;

    public function __construct(
        AuthenticatorService $authenticatorService,
        RequestValidator $requestValidator,
        CustomerParsingService $customerParsingService,
        CustomerActionResolver $customerActionResolver,
        StatisticRecordService $statisticRecordService,
        SerializationService $serializationService
    ) {
        $this->authenticatorService = $authenticatorService;
        $this->requestValidator = $requestValidator;
        $this->customerParsingService = $customerParsingService;
        $this->customerActionResolver = $customerActionResolver;
        $this->statisticRecordService = $statisticRecordService;
        $this->serializationService = $serializationService;
    }

    public function handleRequest(Request $request): Response
    {
        try {
            $this->authenticatorService->authenticateRequest($request);
            $this->requestValidator->validateRequest($request);
        } catch (HttpException $e) {
            return new Response($e->getCode(), $e->getMessage());
        }

        $customers = $this->customerParsingService->parse($request->getFilePath());
        /** @var CustomerAction[] $customerActions */
        $customerActions = [];

        foreach ($customers as $customer) {
            $customerAction = $this->customerActionResolver->resolve($customer);
            $customerActions[] = $customerAction;
            $this->statisticRecordService->incrementRecord($customerAction->getAction());
        }

        return new Response(
            200,
            $this->serializationService->serialize($customerActions, $this->statisticRecordService->getAllRecords())
        );
    }

    public function sendResponse(Response $response): string
    {
        header(sprintf('HTTP/1.1 %d %s', $response->getStatusCode(), $response->getMessage()));
        header('Content-Type: application/json; charset=UTF-8');
        return $response->getContent();
    }
}
