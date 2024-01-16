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

  /**
   * Deletes a specific task in the database.
   * 
   * @param string $id The id of the task.
   * 
   * @return bool True if the task was deleted successfuly. 
   */
  public static function deleteTask(Todo $todo, string $id): bool
  {
    // 1. Remove the task from the given todo.
    $tasks = [];

    // 1.1 Loop through all the tasks of the given todo.
    for ($i = 0; $i < count($todo->tasks); $i++) {
      $task = $todo->tasks[$i];

      // 1.2 Move all the tasks except the desired task to a temporary array.
      if ($task->id != $id) {
        $tasks[] = $task;
      }
    }

    // The desired task, doesn't exist.
    if (count($tasks) == count($todo->tasks))
      return false;

    // 1.3 Override the tasks array in the given todo, with the one, which we have created.
    $todo->tasks = $tasks;

    // 2. Replace file content with new todo object after converting it to JSON.
    // 2.1 Construct the full path of the file with its name and extension.
    $todoFullPath = "C:\\Users\\rima.rayya\\Desktop\\tasko\\src\\db\\todos\\" . $todo->id . ".json";
    // 2.2 Open the file, with pointer starting from the first line.
    $todoFile = fopen($todoFullPath, 'r+');
    // 2.3 Convert the todo object to a string its format JSON.
    $todoJson = json_encode($todo);
    // Empty the file.
    ftruncate($todoFile, 0);
    // 2.4 Replace the content.
    fwrite($todoFile, $todoJson);
    // 2.5 Close the file.
    fclose($todoFile);

    return true;
  }
}
