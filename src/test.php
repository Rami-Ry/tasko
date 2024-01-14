<?php

use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$todoId = TodoRepository::getTaskById("4g-hh-52730");
print_r($todoId);
