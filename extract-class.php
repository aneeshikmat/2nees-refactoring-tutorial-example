<?php
/**
 * This example just to simulate how "Extract Class" can be work
 * 2nees.com
 */

// Smell Code
class WrongExample
{
  public function printExample()
  {
    echo "Example" . PHP_EOL;
  }

  public static function AddLog()
  {
    // add logger
    var_dump("Add Example To Log File...");
  }
}

// Code After Refactoring
class Example
{
  public function printExample()
  {
    echo "Example" . PHP_EOL;
  }
}

class Logger {
  public static function AddLog()
  {
    // add logger
    var_dump("Add Example To Log File...");
  }
}

echo "===============Test Before Refactoring==================" . PHP_EOL;
$x = new WrongExample();
echo $x->printExample() . PHP_EOL;
WrongExample::AddLog();
echo "===============Test After Refactoring==================" . PHP_EOL;
$x = new Example();
echo $x->printExample() . PHP_EOL;
Logger::AddLog();