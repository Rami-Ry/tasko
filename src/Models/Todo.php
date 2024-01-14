<?php

namespace App\Tasko\Models;

use Ramsey\Uuid\Uuid;
use App\Tasko\Models\Task;

/**
 * Todo Class.
 * 
 * @property string $id
 * @property string $name
 * @property string $description
 * @property array<Task> $tasks The tasks of the current todo.
 * @property string $createdAt
 * @property string $updatedAt
 */
class Todo
{
  public string $id;
  public string $createdAt;
  public string $updatedAt;
  public string $name;
  public string $description;
  public array $tasks;

  public function __construct(
    string|null $id,
    string $name,
    string $description,
    string|null $createdAt,
    string|null $updatedAt,
    array $tasks = [],
  ) {
    if ($id == null) {
      $this->id = Uuid::uuid4();
      echo ($id);
    } else {
      $this->id = $id;
    }

    $this->name = $name;
    $this->description = $description;

    if ($createdAt == null) {
      $this->createdAt = date("Y-m-d h:i:s A");
    } else {
      $this->createdAt = $createdAt;
    }

    if ($updatedAt == null) {
      $this->updatedAt = date("Y-m-d h:i:s A");
    } else {
      $this->updatedAt = $updatedAt;
    }

    $this->tasks = $tasks;
  }

  /**
   * Convert the todo std class to a todo object instance from Todo class. 
   * 
   * @param array<\stdClass> The todos objects as an array of stdClass (not instances from Todo).
   * 
   * @return Todo and its tasks.
   */
  public static function ConvertToClassObject(array $todosObjs): array
  {
    /**
     * @var array<Todo>
     */
    $todos = [];

    // Loop through all the files content (Todo standard object).
    for ($i = 0; $i < count($todosObjs); $i++) {
      $todo = $todosObjs[$i];

      /**
       * @var array<Task>
       */
      $tasks = [];

      // Loop through all the tasks of the current standard object read from the file.
      for ($j = 0; $j < count($todosObjs[$i]->tasks); $j++) {
        $task = $todo->tasks[$j];

        // Create a new task instance from the the current task.
        $tasks[] = new Task(
          $task->id,
          $task->name,
          $task->description,
          $task->createdAt,
          $task->updatedAt,
          $task->status,
          $task->deadline
        );
      }

      // Create a new todo instance from the standard object read from the file.
      $todos[] = new Todo(
        $todo->id,
        $todo->name,
        $todo->description,
        $todo->createdAt,
        $todo->updatedAt,
        $tasks
      );
    }

    return $todos;
  }
}

