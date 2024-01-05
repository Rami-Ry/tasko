<?php

use App\Tasko\Helpers\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
  public function testHelloTaskoMessage()
  {
    $message = Helper::sayHello("tasko");

    $this->assertEquals("hello tasko", $message);
  }
}