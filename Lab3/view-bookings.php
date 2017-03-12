<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facility Schedule</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
    <h1>Facility Schedule</h1>
    <p><a href='add-customer.php'>Click here to register a new customer</a>.</p>
    <p><a href='book-facility.php'>Click here to make a reservation</a>.</p>

    <?php
        try {
            //reading the db credentials from a file and opening the connection
            $db_array = parse_ini_file("database.ini");
            $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                ''.$db_array["username"], $db_array["password"]);

            //sql query to select the facility schedule ordering by date
            $sql = "SELECT * FROM facility_schedule ORDER BY booking_date ASC;";

            //executing the query and storing the results
            $cmd = $connection->prepare($sql);
            $cmd->execute();
            $bookings = $cmd->fetchAll();

            //disconnecting the database
            $connection = null;

            //building the table header
            echo '<table class="table table-striped table-hover"><tr><th>Fisrt Name</th><th>Last Name</th><th>Booking Date</th><th>Booking Type</th></tr>';

            //looping through all the reservations got from the database
            foreach ($bookings as $booking) {
                echo'<tr><td>' . $booking["f_name"] . '</td>
            <td>' . $booking["l_name"] . '</td>
            <td>' . $booking["booking_date"] . '</td>
            <td>' . $booking["booking_type"] . '</td></tr>';
            }

            //ending table
            echo '</table>';
        }catch(exception $e) {
            mail('matheusbmleite@gmail.com', 'View Bookings Page Error', $e);
            header('location:error.php');
        }

    ?>

    <!-- Latest   jQuery -->
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
<?php ob_flush()?>