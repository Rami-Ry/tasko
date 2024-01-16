<?php

use App\Tasko\Models\Todo;
use App\Tasko\Repositories\TaskRepository;
use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$todo = TodoRepository::getTodoById("f67566ed-3ff6-46c1-be1e-ad7a5fe7c35f");

if (TaskRepository::deleteTask($todo, "c1ab6b90-bd3a-48b7-a9d3-56fde89c76e8")) {
  echo "Task was deleted successfuly.";
} else {
  echo "Some error was occurred.";
}

