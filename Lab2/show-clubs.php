<!DOCTYPE html>
<!--author: Matheus Leite
    student#: 200350070-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 2</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<?php
    //reading the .ini file to get the database credentials
    $db_array = parse_ini_file("database.ini");

    //building the connection using the array with the db credentials
    $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
        ''.$db_array["username"], $db_array["password"]);

    //building the SQL query to get the clubs from the database
    $sql = "SELECT * FROM clubs ORDER BY club_name ;";

    //execute the query and prepare the results
    $cmd = $connection->prepare($sql);
    $cmd->execute();
    $clubs = $cmd->fetchAll();

    //building the table header
    echo '<table class="table table-striped table-hover"><tr><th>Club Name</th><th>Ground</th><th>Edit</th><th>Delete</th></tr>';

    //looping through all the clubs got from the database
    foreach ($clubs as $club) {
        echo'<tr><td>' . $club["club_name"] . '</td>
            <td>' . $club["ground"] . '</td>
            <td><a href="edit-club.php?club_id='.$club["club_id"].'" class="btn btn-warning">Edit</a></td>
            <td><a href="delete-club.php?club_id='.$club["club_id"].'" class="btn btn-danger confirmation">Delete</a></td></tr>';
    }

    //ending table
    echo '</table>';

    //disconnecting from the database
    $connection = null;

?>

<!-- Latest   jQuery -->
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<!--customized js-->
<script src="js/app.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
