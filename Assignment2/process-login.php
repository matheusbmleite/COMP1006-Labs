<?php

    //Getting the values given by the user
    $username = $_POST['username'];
    $password = $_POST['password'];

    //requiring the database connection
    require_once('db.php');
try {
    //building the sql query
    $sql = "SELECT adminId, password FROM admins WHERE username = :username;";

    //preparing the connection, binding the parameters and execuing the query
    $cmd = $connection->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();

    //getting the query results
    $admin = $cmd->fetch();
    //closing the database connection
    $connection = null;

    //checking if the credentials are valid and starting the session
    if (password_verify($password, $admin['password'])) {

        session_start(); //access to the existing session
        $_SESSION['adminId'] = $admin['adminId']; //store the admin's id in a session variable
        $_SESSION['username'] = $username;
        header('location:admin-panel.php'); //redirecting to the admin-panel

    } else {
        header('location:login.php?error=true');
        exit();
    }
//In case of an exception, redirect to the error page and email me
} catch(exception $e) {
    mail('matheusbmleite@gmail.com', 'process-login error', $e);
    header('location:error.php');
}

?>