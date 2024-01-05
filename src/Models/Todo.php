<?php

namespace App\Tasko\Models;

use App\Tasko\Models\Task;

class Todo
{
  public string $id;
  public string $name;
  public string $description;
  public string $createdAt;
  public string $updatedAt;

  /**
   * The tasks of the current todo.
   * @var array<Task>
   */
  public array $tasks = [];
}

