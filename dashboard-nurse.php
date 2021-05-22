<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');

$account = new Account($conn);
require_once('./includes/components/navbar.php');
$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == "Nurse") {
?>
    <title>Tables</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    <div class="container">
        <br><br>
        <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
        <br><br>
        <?php
        $rows = $account->getUserTypeCreatedByMe($getInfo['user_id'], "Patient");
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
                            <th scope='row' class="text-center">
                            <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a> </th>
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

    <script>
        $('.myTable').DataTable({
            pagingType: 'full_numbers',
            lengthMenu: [
                [5, 10, 20, 50, 100, -1],
                [5, 10, 20, 50, 100, "All"]
            ]
        });
    </script>
<?php
} else {
    header("location:index.php");
}
require_once('./includes/importsAfter.php');
?>