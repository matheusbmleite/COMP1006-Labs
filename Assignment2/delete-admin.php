<?php

    $adminId = $_GET['adminId'];
    require_once('db.php');
    $sql = "DELETE FROM admins WHERE adminId = :adminId";
    $cmd = $connection->prepare($sql);
    $cmd->bindParam(':adminId', $adminId, PDO::PARAM_INT);
    $cmd->execute();
    $connection = null;

    header('location:admins.php');

?>