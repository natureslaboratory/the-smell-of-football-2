<?php

require 'vendor/autoload.php';
require "./config.php";

\Stripe\Stripe::setApiKey(SECRET_KEY);

header('Content-Type: application/json');

$YOUR_DOMAIN = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [
        [
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => "price_1JtvLAA4LssErdxw5FjBESzP",
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
  "shipping_rates" => ["shr_1JtvLVA4LssErdxwhwiToaDI"],
  'success_url' => $YOUR_DOMAIN . '/success?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $YOUR_DOMAIN . '/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

