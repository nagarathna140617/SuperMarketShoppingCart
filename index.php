<?php

require('vendor/autoload.php');

use App\Checkout;
use App\ProductPrice;
use App\Discount;
use App\Product;

$checkout = new Checkout();
$cartItems = [
        $checkout->scan(new Product('A', 50)),
        $checkout->scan(new Product('A', 50)),
        $checkout->scan(new Product('A', 50)), // 130
        $checkout->scan(new Product('B', 30)), 
        $checkout->scan(new Product('B', 30)), // 45
        $checkout->scan(new Product('B', 30)), // 10
        $checkout->scan(new Product('C', 20)), 
        $checkout->scan(new Product('C', 20)),
        $checkout->scan(new Product('C', 20)), // 50 
        $checkout->scan(new Product('C', 20)),
        $checkout->scan(new Product('C', 20)),  // 38
        $checkout->scan(new Product('D', 15)),  // 5
        $checkout->scan(new Product('D', 15)),  // 5
        $checkout->scan(new Product('D', 15)),  // 5
        $checkout->scan(new Product('D', 15)),  // 5
        $checkout->scan(new Product('E', 5)),   // 5
        ];
echo  "My Total Cart Amount is : " . $checkout->total($cartItems); // My Total Cart Amount is : 298

?>
