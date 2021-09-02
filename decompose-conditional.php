<?php
/**
 * This example just to simulate how "Decompose Conditional" can be work
 * 2nees.com
 */

// Smell Code
class WrongExample {
  private int $discount;
  private int $quantity;
  private float $price;

  /**
   * WrongExample constructor.
   * @param int $discount
   * @param int $quantity
   * @param float $price
   */
  public function __construct(int $discount, int $quantity, float $price)
  {
    $this->discount = $discount;
    $this->quantity = $quantity;
    $this->price = $price;
  }

  public function longMethod() {
    if ($this->discount > 1 && $this->quantity > 2) {
      $finalPrice = $this->quantity * $this->price - $this->discount / 100;
    } else {
      $finalPrice = $this->quantity * $this->price;
    }

    return $finalPrice;
  }
}

// Code After Refactoring
class Example {
  private int $discount;
  private int $quantity;
  private float $price;

  /**
   * WrongExample constructor.
   * @param int $discount
   * @param int $quantity
   * @param float $price
   */
  public function __construct(int $discount, int $quantity, float $price)
  {
    $this->discount = $discount;
    $this->quantity = $quantity;
    $this->price = $price;
  }

  public function longMethod() {
    if ($this->hasDiscount()) {
      return $this->calculateDiscount();
    }

    return $this->calculatePrice();
  }

  /**
   * @return bool
   */
  private function hasDiscount(): bool
  {
    return $this->discount > 1 && $this->quantity > 2;
  }

  /**
   * @return float|int
   */
  private function calculatePrice()
  {
    return $this->quantity * $this->price;
  }

  /**
   * @return float|int
   */
  private function calculateDiscount()
  {
    return $this->calculatePrice() - $this->discount / 100;
  }
}

echo "===============Test Before Refactoring==================" . PHP_EOL;
$x = new WrongExample(10, 6, 25);
echo $x->longMethod() . PHP_EOL;
echo "===============Test After Refactoring==================" . PHP_EOL;
$x = new Example(10, 6, 25);
echo $x->longMethod() . PHP_EOL;