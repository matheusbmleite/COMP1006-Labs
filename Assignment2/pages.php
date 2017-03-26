<?php
//Setting the pageTitle variable for the heading
$pageTitle = 'Pages';
//requiring the header
require_once('header.php');

echo '<h1>Pages</h1>';
echo '<a href="add-page.php" class="btn btn-danger">Add Page</a>';
//checking if the user is authenticated
require_once('auth.php');

//Requiring the database connection
require_once('db.php');

try {
    //sql query to select the administrators
    $sql = "SELECT pageId, title FROM pages ORDER BY title;";
    //execute the query and store results
    $cmd = $connection->prepare($sql);
    $cmd->execute();
    $pages = $cmd->fetchAll();

    // starting table and headings
    echo '<table class="table table-striped table-hover">
                    <tr><th>Page</th>
                        <th>Actions</th>
                    </tr>';

    // looping through data
    foreach ($pages as $page) {
        // printing each page as a new row
        echo '<tr><td>' . $page['title'] . '</td><td><a href="add-page.php?pageId=' . $page['pageId'] . '" class="btn btn-sm btn-default" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
            <a href="delete-page.php?pageId=' . $page['pageId'] . '" class="btn btn-sm btn-danger confirmation"><span class="glyphicon glyphicon-remove" title="Delete"></span></td></tr>';
    }
    // closing table
    echo '</table>';

    //disconnect
    $connection = null;
} catch(exception $e) {
    mail('matheusbmleite@gmail.com', 'retrieve pages error', $e);
    header('location:error.php');
}

//Requiring the footer
require_once('footer.php');
?>