<?php

namespace App\Tasko\Repositories;

use App\Tasko\Models\Task;
use App\Tasko\Models\Todo;

class TaskRepository
{
  /**
   * Fetch a specific todo by its id.
   * 
   * @param $id the id that we will the its todo.
   * 
   * @return \App\Tasko\Models\Todo 
   */
  public static function getTaskById(string $id): Task|null
  {
    // Get the todos.
    $todos = TodoRepository::getAll();

    // Loop through all the todos.
    for ($i = 0; $i < count($todos); $i++) {
      $todo = $todos[$i];

      /**
       * @var array<Task>
       */
      $tasks = [];

      // Loop through all the tasks of the current todo.
      for ($j = 0; $j < count($todo->tasks); $j++) {
        $task = $todo->tasks[$j];
        if ($task->id == $id) {
          return $task;
        }
      }
    }
    return null;
  }

  /**
   * Creates a new task.
   * 
   * @param string $name.
   * @param string $description.
   * 
   * @return \App\Tasko\Models\Task
   */
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