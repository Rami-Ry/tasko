<?php

use App\Tasko\Models\Todo;
use App\Tasko\Repositories\TaskRepository;
use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$deleteTodo = TodoRepository::deleteTodo(
  "45d9c047-3cc9-4c48-9b86-0371621a85bd"
);
print_r($deleteTodo);

