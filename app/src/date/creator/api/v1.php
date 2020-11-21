<?php

require_once '../../../../../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RegexLab\DateCreator\DateRegexCreator as Regex;

$c = new \Slim\Container();
configureErrorHandlers($c);
$app = new \Slim\App($c);

$app->post('/', function (Request $request, Response $response, array $args) {
    $params = $request->getParsedBody();
    $date = new Regex($params);
    $date->validate();
    $result = $date->getRegex();
    return $response->withJson(['status' => 'true', 'regex' => $result]);
});

$app->run();

function configureErrorHandlers(\Slim\Container $c)
{
    $c['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
            return $response->withStatus(500)
                ->withJson(['status' => 'false', 'error' => $exception->getMessage()]);
        };
    };

    $c['notAllowedHandler'] = function ($c) {
        return function ($request, $response, $methods) use ($c) {
            return $response->withStatus(405)
                ->withJson(['success' => false, 'message' => 'Method not allowed']);
        };
    };

    $c['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $response->withStatus(404)
                ->withJson(['success' => false, 'message' => 'Page not found']);
        };
    };

    $c['phpErrorHandler'] = function ($c) {
        return function ($request, $response, $error) use ($c) {
            return $response->withStatus(500)
                ->withJson(['status' => 'false', 'error' => $error->getMessage()]);
        };
    };
}
