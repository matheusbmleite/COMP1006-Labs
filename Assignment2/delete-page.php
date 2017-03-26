<?php
    //requiring the user authentication
    require_once('auth.php');
    //requiring the database connection
    require_once('db.php');
    try {
        //getting the pageId from the get array
        $pageId = $_GET['pageId'];
        //Setting up the sql delete query
        $sql = "DELETE FROM pages WHERE pageId = :pageId;";

        //preparing the connection, binding the parameter and executing the query
        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
        $cmd->execute();

        //disconnecting
        $connection = null;

        //redirecting the page
        header('location:pages.php');
    }
        //In case of an exception, redirects to the error page and email me
    catch(exception $e) {
        mail('matheusbmleite@gmail.com', 'admins page error', $e);
        header('location:error.php');
    }


?>