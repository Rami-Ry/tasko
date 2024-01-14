<?php

namespace App\Tasko\Repositories;

use App\Tasko\Models\Todo;
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

    $tasks = Todo::ConvertToClassObject($filesObjs);

    return $tasks;
  }

  /**
   * Fetch a specific todo by its id.
   * 
   * @return \App\Tasko\Models\Todo 
   */
  // public static function getById(string $id): Todo
  // {
  //   // Logic to be added here.

  //   return new Todo();
  // }

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