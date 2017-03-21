<?php
    ob_start();
    $pageTitle = 'Administrators';
    require_once('header.php');
?>

    <h1>Administrators</h1>
<?php
    //accessing the current session
    session_start();
try {
    if (!empty($_SESSION['adminId'])) {
        require_once('db.php');

        //sql query to select the administrators
        $sql = "SELECT adminId, username FROM admins ORDER BY username;";

        //execute the query and store results
        $cmd = $connection->prepare($sql);
        $cmd->execute();
        $admins = $cmd->fetchAll();

        // starting table and headings
        echo '<table class="table table-striped table-hover"><tr><th>Username</th>';

        if (!empty($_SESSION['adminId'])) {
            echo '<th>Edit</th><th>Delete</th></tr>';
        }


        // loop through data
        foreach ($admins as $admin) {
            // print each admin as a new row
            echo '<tr><td>' . $admin['username'] . '</td><td><a href="register.php?adminId=' . $admin['adminId'] . '" class="btn btn-primary">Edit</a></td>
                    <td><a href="delete-admin.php?adminId=' . $admin['adminId'] . '" class="btn btn-danger confirmation">Delete</a></td></tr>';
        }
        // end table
        echo '</table>';

        //disconnect
        $connection = null;
    } else {
        header('location:login.php');
    }
}
catch(exception $e) {
    mail('YourEmail@gmail.com', 'Admins page error', $e);
    header('location:error.php');
}

?>
<?php
    require_once('footer.php');
    ob_flush();
?>