<?php
//Setting the pageTitle variable for the heading
$pageTitle = 'Administrators';
//requiring the header
require_once('header.php');

echo '<h1>Administrators</h1>';

//checking if the user is authenticated
require_once('auth.php');

//Requiring the database connection
require_once('db.php');

try {
    //sql query to select the administrators
    $sql = "SELECT adminId, username FROM admins ORDER BY username;";
    //execute the query and store results
    $cmd = $connection->prepare($sql);
    $cmd->execute();
    $admins = $cmd->fetchAll();

    // starting table and headings
    echo '<table class="table table-striped table-hover">
                    <tr><th>Username</th>
                        <th>Actions</th>
                    </tr>';

    // looping through data
    foreach ($admins as $admin) {
        // printing each admin as a new row
        echo '<tr><td>' . $admin['username'] . '</td><td><a href="register.php?adminId=' . $admin['adminId'] . '" class="btn btn-sm btn-default" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
            <a href="delete-admin.php?adminId=' . $admin['adminId'] . '" class="btn btn-sm btn-danger confirmation"><span class="glyphicon glyphicon-remove" title="Delete"></span></a></td></tr>';
    }
    // closing table
    echo '</table>';

    //disconnect
    $connection = null;
} catch(exception $e) {
    mail('matheusbmleite@gmail.com', 'admins page error', $e);
    header('location:error.php');
}

//Requiring the footer
require_once('footer.php');

?>