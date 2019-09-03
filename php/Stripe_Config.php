<?php
require_once('../stripe-php-master/init.php'); 

$stripe_details = array(
    "secret_key" => "sk_test_lshC4izX7ACR0TxPcqJkBxx2",
    "public_key" => "pk_test_TWuJh9ZsG8lBrimqsEqI2VQg"
);

\Stripe\Stripe::setApiKey($stripe_details['secret_key']);
?>