<?php

use App\Tasko\Models\Todo;
use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$todoId = TodoRepository::getTaskById("4g-hh-52730");
print_r($todoId);


$todo = new Todo(null, "Calculus", "Some shit", null, null);

print_r($todo);