<!DOCTYPE html>
<!--author: Matheus Leite
    student#: 200350070-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Club</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<?php

    $club_id = null;
    $club_name = null;
    $ground = null;

    //checking if the club_id is numeric
    if(is_numeric($_GET['club_id'])) {
        $club_id = $_GET['club_id'];

        //read the db.ini file to get the db credentials
        $db_array = parse_ini_file("database.ini");

        //build the connection with the credentials from the db.ini file
        $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                ''.$db_array["username"], $db_array["password"]);

//        creating the sql command to get the club informatino from the db
        $sql = "SELECT club_name, ground FROM clubs WHERE club_id=:club_id;";

//        passing the sql command to the cmd, binding the parameters and executing the query
        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':club_id', $club_id, PDO::PARAM_INT);
        $cmd->execute();
//        getting the club information returned by this query
        $club = $cmd->fetch();
//        populating the variables
        $club_name = $club['club_name'];
        $ground = $club['ground'];
//        disconnecting
        $connection = null;
    }

?>

<main class="container">
    <h1>Edit Club</h1>
    <a href="show-clubs.php">View Clubs</a>
    <form method="post" action="save-club.php">
        <fieldset class="form-group">
            <label for="club_name" class="col-sm-1">Name*:</label>
            <input name="club_name" id="club_name" required placeholder="Club Name" value="<?php echo $club_name; ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="ground" class="col-sm-1">Ground*:</label>
            <input name="ground" id="ground" required placeholder="Club Ground" value="<?php echo $ground; ?>"/>
        </fieldset>
        <input name="club_id" id="club_id" value="<?php echo $club_id; ?>" type="hidden"/>
        <button class="btn btn-success col-sm-offset-1">Save</button>
    </form>
</main>
<!-- Latest   jQuery -->
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>