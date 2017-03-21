<?php
//read the db.ini file to get the credentials
$db_array = parse_ini_file("db.ini");

//build the connection with the credentials from the db.ini file
$connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
    ''.$db_array["username"], $db_array["password"]);

$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>