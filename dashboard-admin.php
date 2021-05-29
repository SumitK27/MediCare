
<title>Admin's Dashboard</title>

<?php
require_once('./includes/imports.php');
require_once('./includes/components/navbar.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');

$account = new Account($conn);
$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == "Admin") {
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <div class="row">
       <div class="col-2 bg-dark mt-6" style="height: 100vh;">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" >
                <nav class="sb-sidenav accordion text-white text-left" id="sidenavAccordion">
                    <div class="col-12 sb-sidenav-menu">
                     <div class="col-12 sb-sidenav-footer pt-5" style="width: 250px; height: 100px; ">
                        <div class="small">Logged in as:</div>
                        <?php
                                $userInfo = $account->getInfo();
                                echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                         ?>
                     </div>
                        <div  class="col-12 nav flex-column nav-pills text-white" id="v-pills-tab" role="tablist" >
                            <a class="nav-link text-white" href="#v-pills-profile"></a>

                                <a class="nav-link active text-white mb-4" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-controls="v-pills-profile" aria-selected="true"><i class="fa fa-user-circle mr-3"></i>Home</a>

                                <a class="nav-link text-white mb-4" id="v-pills-patient-tab" data-toggle="pill" href="#v-pills-patient" role="tab" aria-controls="v-pills-patient" aria-controls="v-pills-patient" aria-selected="true"><i class="fa fa-user mr-3"></i>Patients</a>

                                <a class="nav-link text-white mb-4" id="v-pills-nurse-tab" data-toggle="pill" href="#v-pills-nurse" role="tab" aria-controls="v-pills-patient" aria-controls="v-pills-nurse" aria-selected="true"><i class="fa fa-file mr-3"></i>Report</a>

                        </div>
                    </div>
                </nav>
            </div>
     </div>

     <div class="col" style="margin-right: 1%; margin-top: 15%; "> 
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h5 class=" text-center">Blank Page</h5>
                </div>
                <div class="tab-pane fade show" id="v-pills-patient" role="tabpanel" aria-labelledby="v-pills-patient-tab">
                <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
                <br><br>
         <?php
         $rows = $account->getAllUsers();
         /* Rows > 0 */
         if ($rows > 0) {
         ?>
            <table class="table table-striped table-fluid myTable">
                <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>First Name</th>
                        <th scope='col'>Last Name</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>User Type</th>
                        <th scope='col'>More Details</th>
                        <th scope='col'>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $row) {
                    ?>
                        <tr>
                            <th scope='row'> <?php echo $row['user_id'] ?> </th>
                            <th scope='row'> <?php echo $row['first_name'] ?> </th>
                            <th scope='row'> <?php echo $row['last_name'] ?> </th>
                            <th scope='row'> <?php echo $row['email'] ?> </th>
                            <th scope='row'> <?php echo $row['role_name'] ?> </th>
                            <th scope='row' class="text-center"> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i> </th>
                            <th scope='row'>
                            <div class="row">
                                    <div class="col">
                                        <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="col">
                                        <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash" ></i></a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    <?php
                    }
                    ?>
            </table>
         <?php
         } else {
         ?>
            <strong>
                <span class='alert alert-danger row justify-content-center align-items-center'>0 Results<span>
            </strong>
         <?php
         }
         ?>
                </div>
                <div class="tab-pane fade" id="v-pills-nurse" role="tabpanel" aria-labelledby="v-pills-nurse-tab">
                    <div class="col">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-nurse" role="tabpanel" aria-labelledby="v-pills-nurse-tab">
                              <h5 class="text-center">Blank Page</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.myTable').DataTable({
            pagingType: 'full_numbers',
            lengthMenu: [
                [1, 5, 10, 20, 50, 100, -1],
                [1, 5, 10, 20, 50, 100, "All"]
            ]
        });
    </script>
<?php
} else {
    header("location:index.php");
}
require_once('./includes/importsAfter.php');
?>