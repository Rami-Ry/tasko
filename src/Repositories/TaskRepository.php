<?php

namespace App\Tasko\Repositories;

use App\Tasko\Models\Task;
use App\Tasko\Models\Todo;

class TaskRepository
{
  public static function createTask(Todo $todo, string $name, string $description, string $deadline): Task
  {
    // Create a new task object.
    $task = new Task($name, $description, $deadline);

    // Add the task to the todo's tasks.
    $todo->tasks[] = $task;

    // Construct the full path of the file with its name and extension.
    $todoFullPath = "C:\\Users\\rima.rayya\\Desktop\\tasko\\src\\db\\todos\\" . $todo->id . ".json";

    // Open the todo file.
    $todoFile = fopen($todoFullPath, 'r+');

    // Convert the todo object to a string its format JSON.
    $todoJson = json_encode($todo);

    // fill the file with the todo.
    fwrite($todoFile, $todoJson);

    // Close the file.
    fclose($todoFile);

    return $task;
  }
}