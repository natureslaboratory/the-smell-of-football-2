<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51JWzY3ISEqxZ1p1TWz1nV4WQPd5O6ep1QoVcNDKsOfBPL4f4XNVwiLzOPa6UP1uVrNdmqcKRfAQQCBZzbUuSse7w007DzEyouD');
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:2006';

try {
    //code...
    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            # TODO: replace this with the `price` of the product you want to sell
            'price' => 'price_1JWzdnISEqxZ1p1TQyuymYdR',
            'quantity' => 1,
        ]],
        'payment_method_types' => [
            'card',
        ],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/success.html',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
    ]);
} catch (\Throwable $th) {
    echo $th->getMessage();
}


// header("HTTP/1.1 303 See Other");
// header("Location: " . $checkout_session->url);
