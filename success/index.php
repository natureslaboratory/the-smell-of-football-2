<?php include '../components/header.php' ?>
<?php

require '../vendor/autoload.php';


try {
    //code...
    if ($_GET["session_id"]) {
        $stripe = new \Stripe\StripeClient(SECRET_KEY);
        $session = $stripe->checkout->sessions->retrieve(trim($_GET["session_id"]));
        $pi = $stripe->paymentIntents->retrieve($session->payment_intent);
    }
    ?>
    <div class="l-block">
        <div class="l-restrict c-cancel">
            <h1>Order Confirmed</h1>
            <a target="_blank" href="<?= $pi->charges->data[0]["receipt_url"] ?>">Receipt</a>
            <div class="c-cancel__details hidden">
                <p>Email</p>
                <p><?= $session->customer_details->email ?></p>
                <p>Address</p>
                <div class="c-cancel__address">
                    <p><?= $session->shipping->address->line1 ?></p>
                    <?= $session->shipping->address->line2 ? "<p>" . $session->shipping->address->line2 . "</p>" : null ?>
                    <p><?= $session->shipping->address->city ?></p>
                    <p><?= $session->shipping->address->postal_code ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php
    // echo "<pre>" . print_r($pi, true) . "</pre?";

} catch (\Throwable $th) {
    //throw $th;
    // echo "<pre>" . print_r($th, true) . "</pre?";
} ?>

<?php include '../components/footer.php' ?>
