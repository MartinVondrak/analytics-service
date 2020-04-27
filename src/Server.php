<?php


namespace MartinVondrak\AnalyticsService;


use MartinVondrak\AnalyticsService\Http\HttpException;
use MartinVondrak\AnalyticsService\Http\Request;
use MartinVondrak\AnalyticsService\Http\Response;
use MartinVondrak\AnalyticsService\Service\AuthenticatorService;
use MartinVondrak\AnalyticsService\Validator\RequestValidator;

class Server
{
    /** @var AuthenticatorService */
    private $authenticatorService;

    /** @var RequestValidator */
    private $requestValidator;

    public function __construct(AuthenticatorService $authenticatorService, RequestValidator $requestValidator)
    {
        $this->authenticatorService = $authenticatorService;
        $this->requestValidator = $requestValidator;
    }

    public function handleRequest(Request $request): Response
    {
        try {
            $this->authenticatorService->authenticateRequest($request);
            $this->requestValidator->validateRequest($request);
        } catch (HttpException $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
        return new Response(200, '');
    }

    public function sendResponse(Response $response): void
    {
        header(sprintf('HTTP/1.1 %d %s', $response->getStatusCode(), $response->getMessage()));
        echo $response->getContent();
    }
}
