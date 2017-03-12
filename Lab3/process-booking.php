<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Reservation</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<?php
    try {
        //saving the data into variables
        $customer = $_POST['customer'];
        $date_string = $_POST['date'];
        $booking_type = $_POST['booking_type'];
        $full_name = explode(' ', $customer, 2); //splitting the data from customer to get the first and last name
        $ok = true;

        //testing if the date is valid and if it is not in the past
        if(!empty($date_string)) {
            if(!empty(strtotime($date_string))) { //strtotime returns null if the string doesn't represent a valid date
                $date = date('Y-m-d', strtotime($date_string)); // converting the string to date and formating as YYYY-MM-DD
                if($date < date('Y-m-d')) {
                    echo 'You\'ve selected a past date <br />';
                    $ok = false;
                }
            } else {
                echo 'The date is invalid, please enter a valid date (YYYY-MM-DD) <br />';
                $ok = false;
            }

        } else {
            echo 'The date field is required <br />';
            $ok = false;
        }

        if($ok) {
            //reading the db credentials from a file and creating the connection
            $db_array = parse_ini_file("database.ini");
            $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                $db_array["username"], $db_array["password"]);

            //Creating the sql query and executing
            $sql = "INSERT INTO facility_schedule VALUES(:f_name, :l_name, :booking_date, :booking_type);";
            $cmd = $connection->prepare($sql);
            $cmd->bindParam(':f_name', $full_name[0], PDO::PARAM_STR, 80);
            $cmd->bindParam(':l_name', $full_name[1], PDO::PARAM_STR, 80);
            $cmd->bindParam(':booking_date', $date, PDO::PARAM_STR, 10);
            $cmd->bindParam(':booking_type', $booking_type, PDO::PARAM_STR, 20);
            $cmd->execute();

            //Displaying a message to the user
            echo "<h1>The reservation has been made successfully!</h1>";
            echo "<a href='book-facility.php'>Click here to make another reservation</a> | 
                <a href='add-customer.php'>Click here to register a customer</a> | 
                <a href='view-bookings.php'>Click here to view all the reservations</a>";
        }
    }catch(exception $e) {
        mail('matheusbmleite@gmail.com', 'Process Booking Page Error', $e);
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