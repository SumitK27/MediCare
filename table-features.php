<?php
require_once('./includes/imports.php');
require_once('./includes/components/navbar.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');

$account = new Account($conn);
$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["name"] == "Admin") {
?>
    <title>Tables</title>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    <div class="container">
        <br><br>
        <?php
        $rows = $account->getAllUsers();
        /* Rows > 0 */
        if ($rows > 0) {
        ?>
            <table class="table table-striped table-fluid" id="myTable">
                <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>First Name</th>
                        <th scope='col'>Last ame</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>User Type</th>
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
                            <th scope='row'> <?php echo $row['name'] ?> </th>
                            <th scope='row'>
                                <button class="btn btn-primary" onclick="document.location='edit.php?user_id=<?php echo $row["user_id"] ?>'">Edit</button>
                                <button class="btn btn-primary" onclick="document.location='delete.php?user_id=<?php echo $row["user_id"] ?>'">Delete</button>
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
        $('#myTable').DataTable({
            pagingType: 'full_numbers',
            lengthMenu: [
                [1, 5, 10, 20, -1],
                [1, 5, 10, 20, "All"]
            ]
        });
    </script>
<?php
} else {
    header("location:index.php");
}
require_once('./includes/importsAfter.php');
?>