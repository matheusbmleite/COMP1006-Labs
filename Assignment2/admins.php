<?php

    //Starting the output buffer because the page may redirect
    ob_start();
    //Setting the pageTitle variable for the heading
    $pageTitle = 'Administrators';
    //requiring the header
    require_once('header.php');

    echo '<h1>Administrators</h1>';

    //accessing the current session
    session_start();

    //Checking if the user is logged in
    if (!empty($_SESSION['adminId'])) {

        //Requiring the database connection
        require_once('db.php');

        //sql query to select the administrators
        $sql = "SELECT adminId, username FROM admins ORDER BY username;";

        //execute the query and store results
        $cmd = $connection->prepare($sql);
        $cmd->execute();
        $admins = $cmd->fetchAll();

        // starting table and headings
        echo '<table class="table table-striped table-hover">
                    <tr><th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>';

        // looping through data
        foreach ($admins as $admin) {
            // printing each admin as a new row
            echo '<tr><td>' . $admin['username'] . '</td><td><a href="register.php?adminId=' . $admin['adminId'] . '" class="btn btn-primary">Edit</a></td>
                    <td><a href="delete-admin.php?adminId=' . $admin['adminId'] . '" class="btn btn-danger confirmation">Delete</a></td></tr>';
        }
        // closing table
        echo '</table>';

        //disconnect
        $connection = null;
    } else {
        header('location:login.php');
    }

    //Requiring the footer
    require_once('footer.php');
    //Flushing the output buffer because the page may redirect
    ob_flush();
?>