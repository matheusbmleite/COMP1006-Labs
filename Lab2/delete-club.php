<?php ob_start(); ?>
    <!DOCTYPE html>
    <!--author: Matheus Leite
        student#: 200350070-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Deleting Club</title>
    </head>
    <body>
    <?php
    //get the club_id from the URL, and checking if it has a numeric value
    $club_id = $_GET["club_id"];
    if(!empty($club_id)) {
        if(is_numeric($club_id)) {

//            reading the init file to get the database credentials
            $db_array = parse_ini_file("database.ini");
//            creating the connection
            $connection = new PDO('mysql:host='. $db_array["host"] . ';dbname=' . $db_array["dbname"], $db_array["username"],
                $db_array["password"]);
//            creating the sql command to delete the club
            $sql = "DELETE FROM clubs WHERE club_id = :club_id;";
//            passing the sql command to the cmd, binding the parameters and executing the query
            $cmd = $connection->prepare($sql);
            $cmd->bindParam(':club_id', $club_id, PDO::PARAM_INT);
            $cmd->execute();
//            disconnecting from db
            $connection = null;
        }
    }

    //    redirecting the user to another page
    header('location:show-clubs.php');
    ?>
    </body>
    </html>
<?php ob_flush(); ?>