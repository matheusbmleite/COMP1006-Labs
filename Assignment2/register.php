<?php
$pageTitle = 'Admin registration';
require_once('header.php');
?>
    <main class="container">
        <h1>Admin Registration</h1>
        <?php
            if(!empty($_GET['error'])) {
                $errorMessage = $_GET['error'];
                echo '<div class="alert alert-danger" id="message">'.$errorMessage.'</div>';
            } else {
                echo '<div class="alert alert-info" id="message">Enter a valid username and password to create your account</div>';
            }

        ?>
        <form method="post" action="process-registration.php">
            <fieldset class="form-group">
                <label for="username" class="col-sm-2">Username:</label>
                <input name="username" id="username" required type="email" placeholder="email@email.com"  />
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-2">Password:</label>
                <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
                <span id="result"></span>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirm" class="col-sm-2">Confirm Password:</label>
                <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            </fieldset>
            <div class="col-sm-offset-2">
                <button class="btn btn-info btnRegister">Register</button>
            </div>
        </form>
    </main>

<?php
require_once('footer.php');
?>