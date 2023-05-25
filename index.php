<?php
require 'vendor/autoload.php';

use Models\Cart;

$basket = new Cart();
$basket->add('R01');
$basket->add('R01');
$basket->addPromotion('R01', 2, 50);

//$basket->get();
$basket->checkoutCart();
exit;