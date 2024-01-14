<?php

use App\Tasko\Repositories\TodoRepository;

require __DIR__ . '/../vendor/autoload.php';

$tasks = TodoRepository::getAll();

print_r($tasks);
