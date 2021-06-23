<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
$account = new Account($conn);
$userInfo = $account->getInfo();
require_once('./includes/components/navbar.php');
require_once('./includes/importsAfter.php');

if (isset($_POST['submit'])) {
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['type']) && isset($_POST['message'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $type = $_POST['type'];
        $message = $_POST['message'];

        $success = $account->insertContact($first_name, $last_name, $email, $type, $message);

        if ($success) {
            $status = "<h4 class='col text-center alert alert-success'>Your request has been sent successfully</h4>";
        }
    } else {
        $status = "<h4 class='col text-center alert alert-danger'>Error occurred while submitting your request</h4>";
    }
}
?>

<title>Contact Us</title>
<link rel="stylesheet" href="./includes/css/style.contact.css">


<div class="container">
    <div class=" text-center mt-5 ">
        <h1>Contact Us</h1>
    </div>
    <div class="container">
        <div class=" text-center ">
            <h3>Feel free to reach out for any questions!!</h3>
        </div>
        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="contact-form" role="form" method="POST">
                                <div class="controls">

                                    <div class="row">
                                        <?php echo isset($status) ? $status : "" ?>
                                    </div>
                                    <!--Name row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> <label for="form_name">First Name *</label> <input id="form_name" type="text" name="first_name" class="form-control" placeholder="Please enter your first name *" required="required" data-error="First name is required."> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <label for="form_last name">Last name *</label> <input id="form_last name" type="text" name="last_name" class="form-control" placeholder="Please enter your last name *" required="required" data-error="Last name is required."> </div>
                                        </div>
                                    </div>
                                    <!--End name row-->


                                    <!--Email+Option-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> <label for="form_email">Email *</label> <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required."> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <label for="form_need">Choose Option *</label> <select id="form_need" name="type" class="form-control" required="required" data-error="Please specify your need.">
                                                    <option value="" selected disabled>--Select Your Option--</option>
                                                    <option value="Feedback">Feedback</option>
                                                    <option value="Report a bug">Report a bug</option>
                                                    <option value="Feature Request">Feature request</option>
                                                    <option value="Other">Other</option>
                                                </select> </div>
                                        </div>
                                    </div>
                                    <!--End Email+Option-->


                                    <!--Message-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> <label for="form_message">Message *</label> <textarea id="form_message" name="message" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea> </div>
                                        </div>
                                    </div>
                                    <!--End Msg-->


                                    <!--Checkbox+Submit btn-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <label class="form-check-label" for="check2">
                                                    <input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">Send me a copy of this message
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-12"> <input type="submit" name="submit" class="btn btn-success btn-send pt-2 btn-block " value="Send Message"> </div>
                                    </div>
                                    <!--End Checkbox+Submit btn-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>