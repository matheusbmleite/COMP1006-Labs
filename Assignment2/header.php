<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        <li><a href="index.php" class="navbar-brand">Assignment 2</a></li>
<!--        <li><a href="albums.php">Albums</a></li>-->

        <?php
        // check if user is logged in
        session_start();

        if (empty($_SESSION['adminId'])) {
            // public links
            echo '<li><a href="login.php">Login</a></li>
                  <li><a href="register.php">Register</a></li>';
        } else {
            //private links
            echo '<li><a href="admins.php">Administrators</a></li>';
        }
        ?>
    </ul>

    <?php
    //showing the username at the top left part of the page and the logout option as a drop-down menu
    if(!empty($_SESSION['adminId'])) {
        echo '<div class="navbar-text pull-right dropdown">
                <span class="glyphicon glyphicon-user"></span>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . ' '.$_SESSION['username'] . '<b class="caret"></b></a> 
                    <ul class="dropdown-menu"> 
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li></ul>
        </div>';
    }
    ?>


</nav>