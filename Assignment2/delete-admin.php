<?php

    $adminId = $_GET['adminId'];
    //requiring the database connection
    require_once('db.php');

    //creating the delete query
    $sql = "DELETE FROM admins WHERE adminId = :adminId";

    //preparing the connection, binding the parameters and executing the query
    $cmd = $connection->prepare($sql);
    $cmd->bindParam(':adminId', $adminId, PDO::PARAM_INT);
    $cmd->execute();
    $connection = null;

    //redirecting the page
    header('location:admins.php');

?>