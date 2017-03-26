<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <!-- bootstrap and other components -->
    <link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/gsdk.css" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="bootstrap3/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<nav class="navbar navbar-ct-red">
    <ul class="nav navbar-nav">
        <?php
        //using glob to get the logo name from the server and setting the logo dynamically
        $logo = glob("logo/*");
        echo '<li><img alt="logo" src="'.$logo['0'].'" class="navbar-brand"></li>';

        // check if user is logged in
        session_start();

        if (empty($_SESSION['adminId'])) {
            //requiring the database connection
            require_once('db.php');

            try {
                $sql = "SELECT * FROM pages;";
                $cmd = $connection->prepare($sql);
                $cmd->execute();
                $pages = $cmd->fetchAll();

                foreach ($pages as $page) {
                    echo '<li><a href="index.php?id='.$page['pageId'].'">'.$page['title'].'</a></li>';
                }
            //In case of an exception, redirect to the error page and email me
            }catch(exception $e) {
                mail('matheusbmleite@gmail.com', 'header public pages error', $e);
                header('location:error.php');
            }
            echo '<li><a href="login.php">Login</a></li>
                  <li><a href="register.php">Register</a></li>';
        } else {
            //private links
            echo '<li><a href="admin-panel.php">Administrator Panel</a></li>';

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