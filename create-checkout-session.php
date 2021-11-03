<?php

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51JWzY3ISEqxZ1p1TWz1nV4WQPd5O6ep1QoVcNDKsOfBPL4f4XNVwiLzOPa6UP1uVrNdmqcKRfAQQCBZzbUuSse7w007DzEyouD');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:2006';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [
        [
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => "price_1JWzdnISEqxZ1p1TQyuymYdR",
        'quantity' => $_POST["book_count"],
    ]
  ],
  'payment_method_types' => [
    'card',
  ],
  'mode' => 'payment',
  "shipping_address_collection" => [
      "allowed_countries" => ["GB"]
  ],
  'success_url' => $YOUR_DOMAIN . '/success?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $YOUR_DOMAIN . '/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

