<?php

use App\Tasko\Models\Todo;
use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$todo = TodoRepository::createTodo("Calculus", "Some shit", []);
print_r($todo);
