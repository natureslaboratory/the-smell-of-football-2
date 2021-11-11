<?php

require 'vendor/autoload.php';
require 'config.php';

function isLocalhost($whitelist = ['127.0.0.1', '::1'])
{
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

$endpoint_secret = isLocalhost() ? LOCALHOST_SECRET : ENDPOINT_SECRET;

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload,
        $sig_header,
        $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

function getAddress(\Stripe\PaymentIntent $paymentIntent)
{
    $addressObject = $paymentIntent["shipping"]["address"];
    $line1 = $addressObject["line1"];
    $line2 = $addressObject["line2"];
    $city = $addressObject["city"];
    $country = $addressObject["country"];
    $postCode = $addressObject["postal_code"];
    $state = $addressObject["state"];

    return "
        $line1<br>" .
        ($line2 ? "$line2<br>" : "") .
        "$city<br>
        $country<br>
        $postCode<br>
        $state<br>
        ";
}

function formatPrice($price) {
    if (strlen($price) == 2) {
        $price .= ".00";
    } else if (strlen($price) == 3) {
        $price .= "0";
    }
    return $price;
}

function getItems($items) {
    $itemTable = "<table><thead><tr><th style='font-weight: bold;'>Item</th><thstyle='font-weight: bold;'>Quantity</th><th style='font-weight: bold;'>Price</th><th style='font-weight: bold;'>Total</th></tr></thead>";
    foreach ($items as $item) {
        $price = $item["amount"]/100;
        $price = formatPrice($price);

        $total = ($item["amount"] * $item["quantity"])/100;
        $total = formatPrice($total);

        $itemTable .= "<tr><td>$item[description]</td><td>$item[quantity]</td><td>$price</td><td>$total</td></tr>";
    }
    $itemTable .= "</table>";
    return $itemTable;
}

function handlePaymentIntent(\Stripe\PaymentIntent $paymentIntent)
{
    $headers = ["Content-type: text/html; charset=iso-8859-1"];

    $fields = [];
    $fields["Name"] = $paymentIntent["shipping"]["name"];
    $fields["Address"] = getAddress($paymentIntent);

    $message = "<table cellspacing='1' cellpadding='6' border='1'>";

    foreach ($fields as $key => $value) {
        $message .= "<tr><td valign='top' style='font-weight: bold;'>$key</td><td>$value</td></tr>";
    }

    $message .= "</table>";
    mail(EMAIL, "Webhook", $message, implode("\r\n", $headers));
}

function handleOrder($order) {
    $headers = ["Content-type: text/html; charset=iso-8859-1"];

    $fields = [];
    $fields["Name"] = $order["shipping"]["name"];

    try {
        //code...
        $fields["Address"] = getAddress($order);
    } catch (\Throwable $th) {
        //throw $th;
        $fields["Address"] = $th->getMessage();
    }

    try {
        //code...
        $fields["Items"] = getItems($order["items"]);
    } catch (\Throwable $th) {
        //throw $th;
        $fields["Items"] = $th->getMessage();
    }

    $message = "<table cellspacing='1' cellpadding='6' border='1'>";

    foreach ($fields as $key => $value) {
        $message .= "<tr><td valign='top' style='font-weight: bold;'>$key</td><td>$value</td></tr>";
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
    case 'order.payment_succeeded':
        $order = $event->data->object;
        handleOrder($order);
        break;
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);
