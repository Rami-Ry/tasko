<?php

namespace App\Tasko\Repositories;

use App\Tasko\Models\Todo;
use App\Tasko\Models\Task;
use App\Tasko\Helpers\DbHelper;

class TodoRepository
{

  /**
   * Fetch all the todos from the database.
   * 
   * @return array<\App\Tasko\Models\Todo>
   */
  public static function getAll(): array
  {
    $filesPaths = dbHelper::getDbFilesPaths("todos");

    $filesObjs = dbHelper::readJsonFiles($filesPaths);

    $todos = Todo::ConvertToClassObject($filesObjs);

    return $todos;
  }

  /**
   * Fetch a specific todo by its id.
   * 
   * @param $id the id that we will the its todo.
   * 
   * @return \App\Tasko\Models\Todo 
   */
  public static function getTodoById(string $id): Todo|null
  {
    // Get the todos
    $todos = self::getAll();

    // Loop through all the todos.
    for ($i = 0; $i < count($todos); $i++) {
      $todo = $todos[$i];
      if ($todo->id == $id) {
        return $todo;
      }
    }
    return null;
  }

  /**
   * Fetch a specific todo by its id.
   * 
   * @param $id the id that we will the its todo.
   * 
   * @return \App\Tasko\Models\Todo 
   */
  public static function getTaskById(string $id): Task|null
  {
    // Get the todos
    $todos = self::getAll();

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
   * Creates a new todo
   * 
   * @param array $data The attributes and values of the todo.
   * 
   * @return \App\Tasko\Models\Todo
   */
  // public static function create(array $data): Todo
  // {
  //   // Logic to be added here.

  //   return new Todo();
  // }

  /**
   * Update a specific todo in the database.
   * 
   * @param string $id The id of the todo to be updated.
   * @param array $data The attributes and its values to update.
   * 
   * @return \App\Tasko\Models\Todo
   */
  // public static function update(string $id, array $data): Todo
  // {
  //   // Login to be added here.

  //   return new Todo();
  // }

  /**
   * Deletes a specific todo in the database.
   * 
   * @param string $id The id of the todo.
   * 
   * @return bool
   */
  public static function delete(string $id): bool
  {
    return true;
  }
}