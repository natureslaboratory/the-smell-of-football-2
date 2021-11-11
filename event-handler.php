<?php

require 'vendor/autoload.php';
require 'config.php';

$endpoint_secret = ENDPOINT_SECRET;

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}

function handlePaymentIntent(\Stripe\PaymentIntent $paymentIntent) {
    $headers = ["Content-type: text/html; charset=iso-8859-1"];

    $fields = [];
    $fields["Name"] = $paymentIntent["shipping"]["name"];
    $fields["Address"] = $paymentIntent["shipping"]["address"];

    $message = "";

    foreach ($fields as $key => $value) {
        $message .= "$key: $value<br>";
    }
    mail(EMAIL, "Webhook", $message, implode("\r\n", $headers));
}



// Handle the event
switch ($event->type) {
  case 'payment_intent.succeeded':
    $paymentIntent = $event->data->object;
    handlePaymentIntent($paymentIntent);
    break;
  // ... handle other event types
  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);