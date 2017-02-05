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
    <h1>Make a reservation</h1>
    <p>Your can only reserve the facility to current customers, to register a customer <a href="add-customer.php">click here</a>.</p>
    <p><a href='view-bookings.php'>Click here to view all the reservations</a>.</p>
    <form method="post" action="process-booking.php">
        <?php
            //showing today's date to help whe user with the booking date
            $today = date("F j, Y");
            echo '<p>Today is: '.$today. '</p><br />';

            //reading the db credentials from a file and opening the connection
            $db_array = parse_ini_file("database.ini");
            $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                                    $db_array["username"], $db_array["password"]);

            //creating and executing the query to get the customers names
            $sql = "SELECT f_name, l_name FROM customers;";
            $cmd = $connection->prepare($sql);
            $cmd->execute();
            $customers = $cmd->fetchAll();

            //creating and executing the query to get the reservation type
            $sql = "SELECT * FROM booking_type;";
            $cmd = $connection->prepare($sql);
            $cmd->execute();
            $booking_types = $cmd->fetchAll();

            //closing the connection
            $connection = null;
        ?>
        <fieldset>
            <label for="customer">Customer:</label>
            <select name="customer" id="customer">
            <?php
                //iterating over the customers array to fill the first dropdown menu
                foreach ($customers as $customer) {
                    echo '<option value="' .$customer['f_name']. ' ' .$customer['l_name']. '">' .$customer['f_name']. ' ' .$customer['l_name']. '</option>';
                }
            ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="date">Date:</label>
            <input name="date" id="date" type="date" required placeholder="YYYY-MM-DD">
        </fieldset>
        <fieldset>
            <label for="booking_type">Booking type:</label>
            <select name="booking_type" id="booking_type">
            <?php
                //iterating over the booking_types array to fill the second dropdown menu
                foreach ($booking_types as $booking_type) {
                    echo '<option value="' .$booking_type['booking_type']. '">' .$booking_type['booking_type']. '</option>';
                }
            ?>
            </select>
        </fieldset>

        <button class = "btn btn-primary">Book!</button>
    </form>

    <!-- Latest   jQuery -->
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>