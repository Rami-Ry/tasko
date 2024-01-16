<?php

namespace App\Tasko\Controllers;

use App\Tasko\Repositories\TodoRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TodosController
{
  public function index(Request $request, Response $response, array $args): Response
  {
    $todos = TodoRepository::getAll();

    $todosJsonStr = json_encode($todos);

    $response->getBody()->write($todosJsonStr);

    return $response->withHeader("Content-Type", "application/json");
  }

  public function view(Request $request, Response $response, array $args): Response
  {
    $todoId = $args["id"];

    $todo = TodoRepository::getTodoById($todoId);

    $todoJsonStr = json_encode($todo);

    $response->getBody()->write($todoJsonStr);

    return $response->withHeader("Content-Type", "application/json");
  }
}