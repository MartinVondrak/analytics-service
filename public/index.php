<?php

require '../vendor/autoload.php';

use MartinVondrak\AnalyticsService\Resolver\CustomerActionResolver;
use MartinVondrak\AnalyticsService\Server;
use MartinVondrak\AnalyticsService\Http\Request;
use MartinVondrak\AnalyticsService\Service\AuthenticatorService;
use MartinVondrak\AnalyticsService\Service\CustomerParsingService;
use MartinVondrak\AnalyticsService\Service\SerializationService;
use MartinVondrak\AnalyticsService\Service\StatisticRecordService;
use MartinVondrak\AnalyticsService\Validator\RequestValidator;

$server = new Server(
    // FIXME use getenv to get user and password from environment variables
    new AuthenticatorService('admin', 'pass'),
    new RequestValidator(),
    new CustomerParsingService(),
    new CustomerActionResolver(),
    new StatisticRecordService(),
    new SerializationService()
);

$request = Request::initFromGlobals();
$response = $server->handleRequest($request);
echo $server->sendResponse($response);
