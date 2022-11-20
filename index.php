<?php

require('vendor/autoload.php');

use App\Checkout;
use App\ProductPrice;
use App\Discount;
use App\Product;

$checkout = new Checkout();
// To add Items in Cart
$cartItems = [
        $checkout->scan(new Product('A', 50)),
        $checkout->scan(new Product('A', 50)),
        $checkout->scan(new Product('A', 50)), 
        $checkout->scan(new Product('B', 30)), 
        $checkout->scan(new Product('B', 30)), 
        $checkout->scan(new Product('B', 30)), 
        $checkout->scan(new Product('C', 20)), 
        $checkout->scan(new Product('C', 20)),  
        $checkout->scan(new Product('C', 20)), 
        $checkout->scan(new Product('C', 20)),
        $checkout->scan(new Product('C', 20)),  
        $checkout->scan(new Product('D', 15)),  
        $checkout->scan(new Product('D', 15)),  
        $checkout->scan(new Product('D', 15)),  
        $checkout->scan(new Product('D', 15)),  
        $checkout->scan(new Product('E', 5)),   
        ];

echo ' <div  style= "font-size : 20"><b>Total Items in my Cart : '. count($cartItems) . '<br>';
echo  "My Cart Total Amount is : $" . $checkout->total($cartItems).'</b> </div>'; // My Total Cart Amount is : 316

?>
