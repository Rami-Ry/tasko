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
    // Get the todos.
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
   * Creates a new todo.
   * 
   * @param string $name.
   * @param string $description.
   * @param array<Task> $tasks.   
   * 
   * @return \App\Tasko\Models\Todo
   */
  public static function createTodo(
    string $name,
    string $description
  ): Todo {
    // Create a new todo object.
    $todo = new Todo($name, $description);

    // Construct the full path of the file with its name and extension.
    $todoFullPath = "C:\\Users\\rima.rayya\\Desktop\\tasko\\src\\db\\todos\\" . $todo->id . ".json";
    $todoFile = fopen($todoFullPath, 'a');

    // Convert the todo object to a string its format JSON.
    $todoJson = json_encode($todo);

    // fill the file with the todo.
    fwrite($todoFile, $todoJson);

    // Close the file.
    fclose($todoFile);

    return $todo;
  }

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
  public static function deleteTodo(string $id): bool
  {
    $todo = self::getTodoById($id);
    $todoFullPath = "C:\\Users\\rima.rayya\\Desktop\\tasko\\src\\db\\todos\\" . $id . ".json";
    unlink($todoFullPath);
    return true;
  }
}
