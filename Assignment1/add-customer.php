<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register customer</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
    <h1>Register new customer</h1>
    <p><a href='book-facility.php'>Click here to make a reservation</a> |
        <a href='view-bookings.php'>Click here to view all the reservations</a></p>
    <form method="post" action="save-customer.php">
        <fieldset>
            <label for="fname">First Name:</label>
            <input name="fname" id="fname" required placeholder="First Name"/>
        </fieldset>
        <fieldset>
            <label for="lname">Last Name:</label>
            <input name="lname" id="lname" required placeholder="Last Name"/>
        </fieldset>
        <fieldset>
            <label for="email">Email:</label>
            <input name="email" id="email" required type="email" placeholder="Email"/>
        </fieldset>
        <fieldset>
            <label for="phone">Phone Number:</label>
            <input name="phone" id="phone" required placeholder="Phone Number"/>
        </fieldset>
        <button class = "btn btn-primary">Save</button>
    </form>
    <!-- Latest   jQuery -->
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>