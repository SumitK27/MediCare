<?php
    require_once('./includes/imports.php');
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');

    $account = new Account($conn);
    $userInfo = $account->getInfo();
?>

<title>Home</title>
<link rel="stylesheet" href="./includes/css/style.home.css">


<!--Navbar-->
<?php
    require_once('./includes/components/navbar.php');
?>
<!--End Navbar-->

<!--Home section-->
<div id="home">
        <div class="landing-text">
            <h1>We Care for Your Health</h1>
            <h2>Every Moment</h2>
            <a href="#" class="btn btn-light btn-lg" role="button">Get Started</a>
        </div>
    </div>
    <!--Home section end-->


    <!--Short info-->
    <div class="padding">
        <div class="container">
            <div class="row">
            <div class="col-sm-6">
                <img class="img-fluid" src="./images//home/Doctors.svg">
            </div>

            <div class="col-sm-6 text-center">
                <h2>Who are we?</h2>
                <p class="lead"> 
                    MediCare aims to provide expert healthcare to patients and the vision of MediCare is “Our core focus will be our patients”. Our staffs are committed to delivering professional services and outstanding hospitality. We are constantly striving to bring the best of medical advancement and service quality to our patient.
                </p>
            </div>
        </div>
    </div>
    </div>
    <!--end short info-->

    <div id="fixed">
    </div>

    <!--Footer started-->
<?php
    require_once('./includes/components/footer.php');
?>
    <!--Footer ended-->

<?php
    require_once('./includes/importsAfter.php');
?>