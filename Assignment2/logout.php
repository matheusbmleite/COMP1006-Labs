<?php
    //accessing the current session
    session_start();
    //destroying the session
    session_destroy();
    header('location:login.php');
?>