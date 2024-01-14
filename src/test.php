<?php

use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$todoId = TodoRepository::getTodoById("35jhgoa-r");
print_r($todoId);
