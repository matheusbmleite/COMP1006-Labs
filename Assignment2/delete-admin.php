<?php

    $adminId = $_GET['adminId'];
    //requiring the database connection
    require_once('db.php');
try{
    //creating the delete query
    $sql = "DELETE FROM admins WHERE adminId = :adminId";

    //preparing the connection, binding the parameters and executing the query
    $cmd = $connection->prepare($sql);
    $cmd->bindParam(':adminId', $adminId, PDO::PARAM_INT);
    $cmd->execute();
    $connection = null;

    //redirecting the page
    header('location:admins.php');
} catch(exception $e) {
    mail('matheusbmleite@gmail.com', 'delete admin error', $e);
    header('location:error.php');
}

?>