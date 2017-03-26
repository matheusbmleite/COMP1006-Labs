<?php

    require_once('auth.php');
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
    catch(exception $e) {
        mail('matheusbmleite@gmail.com', 'admins page error', $e);
        header('location:error.php');
    }


?>