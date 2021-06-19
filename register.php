<?php
require_once('./includes/imports.php');
require_once('./includes/components/navbar.php');
require_once('./includes/config.php');
require_once('./includes/classes/FormSanitizer.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);

if (isset($_POST["register"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $success = $account->register($firstName, $lastName, $email, $password, $password2, 1);

    if ($success) {
        // Store Session
        $_SESSION["userLoggedIn"] = $email;

        header("Location: index.php");
    }
}
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<title>Sign-up</title>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-sm-5">
            <!-- Default form register -->
            <form class="text-center border border-light p-5" action="" method="POST">

                <p class="h4 mb-4">Sign up</p>

                <div class="form-row mb-4">
                    <div class="col">
                        <!-- First name -->
                        <?php echo $account->getError(Constants::$nameCharacters); ?>
                        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First name" value="<?php getInputValue("firstName") ?>"  maxlength="25" required>
                    </div>
                    <div class="col">
                        <!-- Last name -->
                        <?php echo $account->getError(Constants::$nameCharacters); ?>
                        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name" value="<?php getInputValue("lastName") ?>" maxlength="25" required>
                    </div>
                </div>

                <!-- E-mail -->
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" id="email" name="email" class="form-control mb-4" placeholder="E-mail" value="<?php getInputValue("email") ?>" required>

                <!-- Password -->
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password" aria-describedby="password"  maxlength="25" required>

                <input type="password" id="password2" name="password2" class="form-control mb-4" placeholder="Re-enter Your Password" aria-describedby="password2"  maxlength="25" required>
                <small id="RegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                    At least 8 characters and 1 digit
                </small>

                <!-- Sign up button -->
                <button class="btn btn-info my-4 btn-block" type="submit" name="register">Sign Up</button>

                <!-- Social register -->
                <p>or sign up with:</p>

                <a href="#" class="mx-2" role="button"><i class="fab fa-google light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

                <hr>

                <!-- Terms of service -->
                <p>By clicking
                    <em>Sign up</em> you agree to our
                    <br><a href="" target="_blank">terms of service</a>

            </form>
            <!-- Default form register -->
        </div>
    </div>
</div>

<?php
require_once('./includes/importsAfter.php');
?>