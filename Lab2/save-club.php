<?php ob_start(); ?>
    <!DOCTYPE html>
    <!--author: Matheus Leite
        student#: 200350070-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Saving Club</title>
    </head>
    <body>
    <?php

    //read the db.ini file to get the credentials
    $db_array = parse_ini_file("database.ini");

    //store the form inputs into variables
    $club_id = $_POST['club_id'];
    $club_name = $_POST['club_name'];
    $ground = $_POST['ground'];

    //    variable to indicate if there is 1 or more errors
    $ok = true;

    // validating the inputs before saving
    if(empty($club_name)) {
        echo 'Name is required<br />';
        $ok = false;
    }
    if(empty($ground)) {
        echo 'Ground is required<br />';
        $ok = false;
    }

    if($ok) {
        //build the connection with the credentials from the db.ini file
        $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
            ''.$db_array["username"], $db_array["password"]);

        //set up an SQL instruction to update the club
        $sql = "UPDATE clubs SET club_name = :club_name, ground = :ground WHERE club_id = :club_id;";



        //pass the input variables to the SQL command
        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':club_name', $club_name, PDO::PARAM_STR, 50);
        $cmd->bindParam(':ground', $ground, PDO::PARAM_INT);
        $cmd->bindParam(':club_id', $club_id, PDO::PARAM_INT);


        //execute the UPDATE
        $cmd->execute();

        //disconnect
        $connection = null;

        //    redirecting the user to another page
        header('location:show-clubs.php');
    }
    ?>
    </body>
    </html>
<?php ob_flush(); ?>