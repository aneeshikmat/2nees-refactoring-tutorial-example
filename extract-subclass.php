<?php
/**
 * This example just to simulate how "Extract SubClass" can be work
 * 2nees.com
 */

// Smell Code
class WrongCustomer
{
  protected function customerDetails()
  {
    echo "Welcome To Customer Page" . PHP_EOL;
  }

  public function ourCustomer()
  {
    echo "regularCustomer" . PHP_EOL;
    $this->customerDetails();
  }

  public function preferredOurCustomer()
  {
    echo "preferredCustomer" . PHP_EOL;
    $this->customerDetails();
  }
}

// Code After Refactoring
class Customer
{
  protected function customerDetails()
  {
    echo "Welcome To Customer Page" . PHP_EOL;
  }

  public function ourCustomer()
  {
    echo "regularCustomer" . PHP_EOL;
    $this->customerDetails();
  }
}

class CustomerPreferred extends Customer{
  public function ourCustomer()
  {
    echo "preferredCustomer" . PHP_EOL;
    $this->customerDetails();
  }
}

echo "===============Test Before Refactoring==================" . PHP_EOL;
$x = new WrongCustomer();
$x->ourCustomer();
$x->preferredOurCustomer();
echo "===============Test After Refactoring==================" . PHP_EOL;
$x = new Customer();
$x->ourCustomer();
$x = new CustomerPreferred();
$x->ourCustomer();