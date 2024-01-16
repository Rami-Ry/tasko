<?php

define("WORKING_DIR", __DIR__ . "/../");

use App\Tasko\Controllers\TodosController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/todos', [TodosController::class, 'index']);
$app->get('/todos/{id}', [TodosController::class, 'view']);

$app->run();