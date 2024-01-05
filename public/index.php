<?php

use App\Tasko\Helpers\Helper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $message = Helper::sayHello("Tasko");

    $response->getBody()->write($message);

    return $response;
});

$app->run();