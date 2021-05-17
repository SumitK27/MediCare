<?php
require_once('./includes/imports.php');
require_once('./includes/components/navbar.php');
require_once('./includes/config.php');
require_once('./includes/classes/FormSanitizer.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<title>Login</title>

<?php
    if(isset($_POST["login"])){
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $success = $account->login($email, $password);
        echo "<h1>" . $success . "</h1>";
        if($success) {
            // Store session
            $_SESSION["userLoggedIn"] = $email;

            // Redirect to home page
            header("Location: dashboard.php");
        }
    }
    if (isset($_SESSION["userLoggedIn"])) {
        header("Location: dashboard.php");
    }
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-5">
            <form class="text-center border border-light p-5" action="" method="POST">
                <p class="h4 mb-4">Login</p>
                <!-- Email -->
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="email" id="email" name="email" class="form-control mb-4" placeholder="E-mail">

                <!-- Password -->
                <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password">

                <div class="d-flex justify-content-around">
                    <div>
                        <!-- Remember me -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                            <label class="custom-control-label" for="remember">Remember me</label>
                        </div>
                    </div>
                    <div>
                        <!-- Forgot password -->
                        <a href="">Forgot password?</a>
                    </div>
                </div>

                <!-- Sign in button -->
                <button class="btn btn-info btn-block my-4" type="submit" name="login" id="login">Login in</button>

                <!-- Register -->
                <p>Not a member?
                    <a href="./register.php">Register</a>
                </p>

                <!-- Social login -->
                <p>or sign in with:</p>

                <a href="#" class="mx-2" role="button"><i class="fab fa-google light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

            </form>
        </div>
    </div>
</div>

<?php
require_once('./includes/importsAfter.php');
?>