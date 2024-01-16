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
    string $name,
    string $description,
    string|null $id = null,
    string|null $createdAt = null,
    string|null $updatedAt = null,
    array|null $tasks = null,
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

    if ($tasks == null) {
      $this->tasks = [];
    } else {
      $this->tasks = $tasks;
    }
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
          $task->name,
          $task->description,
          $task->deadline,
          $task->id,
          $task->createdAt,
          $task->updatedAt,
          $task->status,
        );
      }

      // Create a new todo instance from the standard object read from the file.
      $todos[] = new Todo(
        $todo->name,
        $todo->description,
        $todo->id,
        $todo->createdAt,
        $todo->updatedAt,
        $tasks
      );
    }

    return $todos;
  }
}

