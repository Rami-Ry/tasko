<?php

namespace App\Tasko\Models;

use Ramsey\Uuid\Uuid;

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
  public string $id;
  public string $name;
  public string $description;
  public string $createdAt;
  public string $updatedAt;
  public string $status;
  public string $deadline;

  public function __construct(
    string $name,
    string $description,
    string $deadline,
    string|null $id = null,
    string|null $createdAt = null,
    string|null $updatedAt = null,
    string $status = 'OPEN',
  ) {
    if ($id == null) {
      $this->id = Uuid::uuid4();
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

    $this->status = $status;
    $this->deadline = $deadline;
  }
}