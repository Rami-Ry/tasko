<?php

namespace App\Tasko\Models;

/**
 * Task class.
 * 
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $deadline
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $status

 */
class Task
{
  public function __construct(
    public string $id,
    public string $name,
    public string $description,
    public string $createdAt,
    public string $updatedAt,
    public string $status,
    public string $deadline,
  ) {

  }

}