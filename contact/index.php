<?php 

if (!empty($_POST)) {
    $headers = [];

    $headers[] = "Content-type: text/html; charset=iso-8859-1";


    $success = mail(
        "caleb@natureslaboratory.co.uk",
        "Message from $_POST[name] on $_SERVER[HTTP_HOST]",
        "Name: $_POST[name]<br>Email: $_POST[email]<br>Message: $_POST[message]",
        implode("\r\n", $headers)
    );

    $uri = explode("?", $_SERVER["REQUEST_URI"])[0];

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$uri" . "?success=" . ($success ? "true" : "false");
    header("Location: $actual_link");
} else {
?>

<?php include '../components/header.php' ?>
        <section class="l-block">
            <div class="l-restrict c-contact">
                <img class="c-contact__image" src="/assets/images/book_small.jpg" alt="The Smell Of Football 2 Book">
                <?php if (array_key_exists("success", $_GET) && $_GET["success"] == "true") {
                    echo "<p style='align-self: start; margin-top: 2rem;'>Your message has been sent!</p>";
                } else { ?>
                <form class="c-form" method="POST">
                    <div class="c-form__wrapper">
                        <h2 class="c-form__title">Get In Touch</h2>
                        <?php if (array_key_exists("success", $_GET) && $_GET["success"] == "false") {
                            echo "<p>Something went wrong.</p>";
                        } ?>
                        <div class="c-form__section">
                            <label class="c-form__label" for="name">Name</label>
                            <input class="c-form__input" id="name" name="name" type="text">
                        </div>
                        <div class="c-form__section">
                            <label class="c-form__label" for="email">Email</label>
                            <input class="c-form__input" id="email" name="email" type="text">
                        </div>
                        <div class="c-form__section">
                            <label class="c-form__label" for="message">Message</label>
                            <textarea class="c-form__textarea" name="message" id="message"></textarea>
                        </div>
                        <div class="c-form__section">
                            <input class="c-button c-submit" type="submit" value="Send">
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </section>
<?php include '../components/footer.php' ?>
<?php } ?>