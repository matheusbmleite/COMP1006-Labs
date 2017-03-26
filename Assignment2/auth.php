<?php
//accessing the current session
session_start();

//if the user is not logged in, redirect to the login page
if(empty($_SESSION['adminId'])) {
    header('location:login.php');
    exit();
}
?>