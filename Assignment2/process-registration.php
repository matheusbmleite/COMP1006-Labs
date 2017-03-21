<?php

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $adminId = $_POST['adminId'];
    $ok = true;
    $error = '';

    //checking the data
    if(empty($username)) {
        $error = $error.'The username is required <br />';
        $ok = false;
    }

    if(empty($password) || strlen($password) < 8) {
        $error = $error.'The password is invalid <br />';
        $ok = false;
    }

    if($password != $confirm) {
        $error = $error.'Passwords do not match <br />';
        $ok = false;
    }

    require_once('db.php'); //requiring the connection to the database
    $sql = 'SELECT * FROM admins WHERE username = :username;';
    $cmd = $connection->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();

    //Checking if the username is already being used
    if(!empty($cmd->fetchAll()) && empty($adminId)) {
        $error = $error.'The username is already being used <br />';
        $ok = false;
    }

    if($ok) {
        if(!empty($adminId)) {
            $sql = 'UPDATE admins SET username = :username, password = :password WHERE adminId = :adminId;';
        } else {
            $sql = 'INSERT INTO admins(username, password) VALUES (:username, :password);';
        }


        //hashing the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 80);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        if(!empty($adminId)) {
            $cmd->bindParam(':adminId', $adminId, PDO::PARAM_INT);
        }

        $cmd->execute();
        $connection = null;

        if(!empty($adminId)) {
            header('location:admins.php');
        } else {
            header('location:login.php');
        }


    } else {
        header('location:register.php?error='.$error);
    }

?>