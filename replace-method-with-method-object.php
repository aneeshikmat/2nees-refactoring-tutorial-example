<?php
/**
 * This example just to simulate how "Replace Method with Method Object" can be work
 * 2nees.com
 */

// Smell Code
class WrongExample {
  public function longMethod(int $valueOne, int $valueTwo) {
    $calculationOne = ($valueOne * 20) - $valueTwo;
    $calculationOTwo = $calculationOne + ($valueTwo - 5);
    $calculationThree = $calculationOne + $calculationOTwo;
    if($calculationOne < $calculationOTwo){
      $calculationThree += 10;
    }

    return $calculationThree - $calculationOTwo + $calculationOne;
  }
}

// Code After Refactoring
class Example {
  public function longMethod(int $valueOne, int $valueTwo): int
  { // After refactoring, we just call the new method form new class...
    return (new ReplacedLongMethodToObject($valueOne, $valueTwo))->niceName();
  }
}

class ReplacedLongMethodToObject {
  private int $valueOne;
  private int $valueTwo;
  private int $calculationOne;
  private int $calculationOTwo;
  private int $calculationThree;

  /**
   * LongMethodToObject constructor.
   * @param int $valueOne
   * @param int $valueTwo
   */
  public function __construct(int $valueOne, int $valueTwo)
  {
    $this->valueOne = $valueOne;
    $this->valueTwo = $valueTwo;
  }

  public function niceName(): int
  {
    $this->calculateOne();
    $this->calculateTwo();
    $this->calculateThree();

    return $this->calculationThree - $this->calculationOTwo + $this->calculationOne;
  }

  private function calculateOne(): void
  {
    $addToValueOne = $this->valueOne * 20;
    $this->calculationOne = $addToValueOne - $this->valueTwo;
  }

  private function calculateTwo(): void
  {
    $addToValueTwo = $this->valueTwo - 5;
    $this->calculationOTwo = $this->calculationOne + $addToValueTwo;
  }

  private function calculateThree(): void
  {
    $this->calculationThree = $this->calculationOne + $this->calculationOTwo;
    if ($this->calculationOne < $this->calculationOTwo) {
      $this->calculationThree += 10;
    }
  }
}

echo "===============Test Before Refactoring==================" . PHP_EOL;
$x = new WrongExample();
echo $x->longMethod(10, 5) . PHP_EOL;
echo "===============Test After Refactoring==================" . PHP_EOL;
$x = new Example();
echo $x->longMethod(10, 5) . PHP_EOL;