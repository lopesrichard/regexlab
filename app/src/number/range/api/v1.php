<?php

require_once '../../../../../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RegexLab\NumberRange\NumberRegexGenerator as Regex;

$c = new \Slim\Container();
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $response->withStatus(500)
            ->withHeader('Access-Control-Allow-Origin', 'https://regex-lab.herokuapp.com/')
            ->withJson(['status' => 'false', 'error' => $exception->getMessage()]);
    };
};

$app = new \Slim\App($c);

$app->get('/{from}/{to}', function (Request $request, Response $response, array $args) {
    $result = Regex::getRegexFromRange($args['from'], $args['to']);
    return $response->withHeader('Access-Control-Allow-Origin', 'https://regex-lab.herokuapp.com/')
                    ->withJson(['status' => 'true', 'regex' => $result]);
});

$app->run();