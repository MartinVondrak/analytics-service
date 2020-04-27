<?php

require '../vendor/autoload.php';

use MartinVondrak\AnalyticsService\Server;
use MartinVondrak\AnalyticsService\Http\Request;
use MartinVondrak\AnalyticsService\Service\AuthenticatorService;
use MartinVondrak\AnalyticsService\Service\CustomerParsingService;
use MartinVondrak\AnalyticsService\Validator\RequestValidator;

$request = Request::initFromGlobals();
$server = new Server(new AuthenticatorService('admin', 'pass'), new RequestValidator(), new CustomerParsingService());
$response = $server->handleRequest($request);
$server->sendResponse($response);
