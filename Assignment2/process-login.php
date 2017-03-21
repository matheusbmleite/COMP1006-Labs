<?php ob_start();

$username = $_POST['username'];
$password = $_POST['password'];

require_once('db.php');

$sql = "SELECT adminId, password FROM admins WHERE username = :username;";

$cmd = $connection->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();

$admin = $cmd->fetch();

$connection = null;

if(password_verify($password, $admin['password'])) {

    session_start(); //access to the existing session
    $_SESSION['adminId'] = $admin['adminId']; //store the user's id in a session variable
    $_SESSION['username'] = $username;
    header('location:admins.php'); //redirecting the user


} else {
    header('location:login.php?error=true');
    exit();
}

ob_flush(); ?>