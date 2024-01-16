<?php

use App\Tasko\Models\Todo;
use App\Tasko\Models\Task;
use App\Tasko\Repositories\TaskRepository;
use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$todo = TodoRepository::getTodoById("f67566ed-3ff6-46c1-be1e-ad7a5fe7c35f");

$todo->name = "New Name";
$todo->description = "New Description";

TodoRepository::update($todo);