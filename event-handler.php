<?php

require 'vendor/autoload.php';
require 'config.php';

function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

$endpoint_secret = isLocalhost() ? LOCALHOST_SECRET : ENDPOINT_SECRET;

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

function getAddress(\Stripe\PaymentIntent $paymentIntent) {
    // try {
    //     $addressObject = $paymentIntent["shipping"]["address"];
    //     $line1 = $addressObject["line1"];
    //     $line2 = $addressObject["line2"];
    //     $city = $addressObject["city"];
    //     $country = $addressObject["country"];
    //     $postCode = $addressObject["postal_code"];
    //     $state = $addressObject["state"];
    //     return `
    //     $addressObject<br>
    //     $line1<br>
    //     $line2<br>
    //     $city<br>
    //     $country<br>
    //     $postCode<br>
    //     $state<br>
    //     `;
    // } catch (Exception $e) {
    //     return $e->getMessage();
    // }
    return "Hello There";
}

function handlePaymentIntent(\Stripe\PaymentIntent $paymentIntent) {
    $headers = ["Content-type: text/html; charset=iso-8859-1"];

    $fields = [];
    $fields["Name"] = $paymentIntent["shipping"]["name"];
    $fields["Address"] = getAddress($paymentIntent);

    $message = "<table>";

    foreach ($fields as $key => $value) {
        $message .= "<tr><td>$key</td><td>$value<td></tr>";
    }

    $message .= "</table>";
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