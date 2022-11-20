<?php

namespace App;

class Checkout implements CheckoutInterface
{
    /**
     * @var array $cart
     */
    public $cart = [];

    /**
     * @var array $discounts
     */
    public $discounts = [];

    /**
     * @var array
     */
    public $stats = [];

    public function __construct()
    {
        $this->stats = [
            'A' => 0,
            'B' => 0,
            'C' => 0,
            'D' => 0,
            'E' => 0,
        ];

        $this->discounts = [
            'A' => new Discount(3, 20),
            'B' => new Discount(2, 15),
            'C' => [new Discount(2, 2), new Discount(3, 10)],
            'D' => ['A' => new Discount(1, 10)],
            'E' => new Discount(1, 0),
        ];
    }

    /**
     * Adds an item to the checkout
     *
     * @param Product $product
     */
    public function scan(Product $product)
    {
        $this->stats[$product->getSku()]++;

        return $this->cart[] = $product;
    }

    /**
     * Calculates the total price of all items in this checkout
     *
     * @return int
     */
    public function total(): int
    {
        $standardPrices = array_reduce($this->cart, function ($total, Product $product) {
            $total += $product->getPrice();
            return $total;
        }) ?? 0;

        $totalDiscount = $this->calculateDiscount();

        return $standardPrices - $totalDiscount;
    }

    /**
     * @return int
     */
    private function calculateDiscount() : int
    {
        $totalDiscount = 0;
        echo '<pre>';
        foreach ($this->discounts as $key => $discount) {
            if(is_object($discount)){
                    if ($this->stats[$key] >= $discount->getThreshold()) {
                    $numberOfSets = floor($this->stats[$key] / $discount->getThreshold());
                    $totalDiscount += ($discount->getAmount() * $numberOfSets);
                }
            } else{
                foreach($discount as $indexKey => $discountVal){
                    if ($this->stats[$key] >= $discountVal->getThreshold()) {
                        $numberOfSets = floor($this->stats[$key] / $discountVal->getThreshold());
                        $totalDiscount += ($discountVal->getAmount() * $numberOfSets);
                    }
                }
            }
            
        }

        return $totalDiscount;
    }
}
