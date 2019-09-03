<?php
require_once('../stripe-php-master/init.php'); 
require_once('Stripe_Config.php');
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
// \Stripe\Stripe::setApiKey('sk_test_lshC4izX7ACR0TxPcqJkBxx2');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$total_cost = $_POST['total_cost'];

echo "total cost being submitted to Stripe is: " . $total_cost;
$charge = \Stripe\Charge::create([
    'amount' => $total_cost,
    'currency' => 'cad',
    'description' => 'Example charge',
    'source' => $token,
]);

echo "<pre>";
var_dump($_POST);

?>
