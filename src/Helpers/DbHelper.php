<?php


namespace App\Tasko\Helpers;

//define("WORKING_DIR", __DIR__ . "/../");

class DbHelper
{
  /**
   * Get the directory path and the Db path.
   * 
   * @param $entityFolderName Write the folder name that you want to get the path of. 
   * 
   * @return string $directory The path of the provided file. 
   */
  public static function getDbEntityPath(string $entityFolderName): string
  {
    $filePath = getcwd();

    $directory = $filePath . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . $entityFolderName;

    return $directory;
  }

  /**
   * Get the list of the json files .
   * 
   * @param $entityFolderName Write the folder name that you want to get the path of.
   * 
   * @return array<string> $dirFiles The names of the files.
   */
  public static function getJsonFiles(string $entityFolderName): array
  {
    $directoryPath = self::getDbEntityPath($entityFolderName);

    // Get the list of files in the directory
    $dirFiles = scandir($directoryPath);

    // Loop through all the files in the directory, and check only for files.
    for ($i = 0; $i < count($dirFiles); $i++) {
      $extension = pathinfo($dirFiles[$i], PATHINFO_EXTENSION);
      if ($extension == "json") {
        $jsonFiles[] = "$dirFiles[$i]";
      } else {
        echo ("");
      }
    }

    return $jsonFiles;
  }

  /**
   * Get the directory path of the files.
   * 
   * @param $entityFolderName Write the folder name that you want to get the path of.
   * 
   * @return array<string> glob($pattern) The paths of the files.
   */
  public static function getDbFilesPaths(string $entityFolderName): array
  {
    // Get the paths of the Db files 
    $pattern = self::getDbEntityPath($entityFolderName) . '\*.json';

    return glob($pattern);
  }

  /**
   * Read the contents of the provided JSON files paths and return them.
   * 
   * @param array<string> The files paths.
   * 
   * @return array<\stdClass> The contents of the provided JSON files paths.
   */
  public static function readJsonFiles(array $filesPaths): array
  {
    /**
     * @var array<\stdClass>
     */
    $filesContent = [];

    // Loop through all the provided JSON files.
    for ($i = 0; $i < count($filesPaths); $i++) {
      $filePath = $filesPaths[$i];
      // Read the content of the JSON file. 
      $fileContentJsonStr = file_get_contents($filePath);
      // Convert the JSON string to a PHP Object.
      $fileContent = json_decode($fileContentJsonStr);
      // Add the object to the array.
      $filesContent[] = $fileContent;
    }
    return $filesContent;
  }
}

