<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Register</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<?php
    try{
        //reading the db credentials from the a file
        $db_array = parse_ini_file("database.ini");

        //Storing the form inputs into variables
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $ok = true;

        //Testing if the required fields were filled
        if(empty($fname)) {
            echo 'First Name is Required<br />';
            $ok = false;
        }
        if(empty($lname)) {
            echo 'Last Name is Required<br />';
            $ok = false;
        }
        if(empty($email)) {
            echo 'Email is Required<br />';
            $ok = false;
        }
        if(empty($phone)) {
            echo 'Phone is Required<br />';
            $ok = false;
        }

        //creating the connection to the database, the query, executing the query and closing the connection
        if($ok) {

            $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                $db_array["username"], $db_array["password"]);

            $sql = "INSERT INTO customers VALUES(:fname, :lname, :email, :phone);";

            $cmd = $connection ->prepare($sql);
            $cmd->bindParam(':fname', $fname, PDO::PARAM_STR, 80);
            $cmd->bindParam(':lname', $lname, PDO::PARAM_STR, 80);
            $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 10);

            $cmd->execute();

            $connection = null;

            //Showing a message to the user
            echo "<h1>The customer has been saved successfully!</h1>";
            echo "<a href='book-facility.php'>Click here to make a facility reservation</a> | 
                <a href='add-customer.php'>Click here to add another customer</a> | 
                <a href='view-bookings.php'>Click here to view all the reservations</a>";
        }
    }catch(exception $e) {
        mail('matheusbmleite@gmail.com', 'Save Customer Page Error', $e);
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