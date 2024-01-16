<?php

use App\Tasko\Models\Todo;
use App\Tasko\Repositories\TaskRepository;
use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$egal = TodoRepository::createTodo("Egal", "Egal desc");
print_r($egal);