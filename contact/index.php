<?php 

if (!empty($_POST)) {
    $success = mail(
        "caleb@natureslaboratory.co.uk",
        "Test",
        "Name: $_POST[name]<br>Email: $_POST[email]<br>Message: $_POST[message]"
    );
    if (!$success) {
        $errorMessage = error_get_last()["message"];
        echo "No success! <br>";
        echo $success;
        echo $errorMessage;
    } else {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: $actual_link");
    }
} else {
?>

<?php include '../components/header.php' ?>
        <section class="l-block">
            <div class="l-restrict c-contact">
                <img class="c-contact__image" src="/assets/images/book_small.jpg" alt="The Smell Of Football 2 Book">
                <form class="c-form" method="POST">
                    <div class="c-form__wrapper">
                        <h2 class="c-form__title">Get In Touch</h2>
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
            </div>
        </section>
<?php include '../components/footer.php' ?>
<?php } ?>