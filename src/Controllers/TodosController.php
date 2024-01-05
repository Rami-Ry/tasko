<?php

namespace App\Tasko\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TodosController
{
  public static $todos = [
    [
      "id" => "34342424",
      "name" => "Todo 1",
    ],

    [
      "id" => "2r3-33-jj-s",
      "name" => "Todo 2",
    ]
  ];

  public function index(Request $request, Response $response, array $args): Response
  {
    $todosJsonStr = json_encode(TodosController::$todos);

    $response->getBody()->write($todosJsonStr);

    return $response->withHeader("Content-Type", "application/json");
  }

  public function view(Request $request, Response $response, array $args): Response
  {
    $todoId = $args["id"];

    $todo = [];

    for ($i = 0; $i < count(TodosController::$todos); ++$i) {
      $currentTodo = TodosController::$todos[$i];
      if ($currentTodo["id"] == $todoId) {
        $todo = $currentTodo;
        break;
      }
    }

    $todoJsonStr = json_encode($todo);

    $response->getBody()->write($todoJsonStr);

    return $response->withHeader("Content-Type", "application/json");
  }
}