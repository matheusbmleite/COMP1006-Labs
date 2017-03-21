<?php
    ob_start();
    $pageTitle = 'Admin Login';
    require_once('header.php');
?>

    <main class="container">
        <h1>Log In</h1>
        <?php
        $error = $_GET['error'];

        if($error) {
            echo '<div class="alert alert-danger" id="message">Authentication failed. Please try again.</div>';
        } else {
            echo '<div class="alert alert-success" id="message">Please, use your admin credentials to log in.</div>';
        }
        ?>
        <form method="post" action="process-login.php">
            <fieldset class="form-group">
                <label for="username" class="col-sm-2">Username:</label>
                <input name="username" id="username" required type="email" placeholder="email@email.com" />
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-2">Password:</label>
                <input type="password" name="password" required />
            </fieldset>
            <fieldset class="col-sm-offset-2">
                <button class="btn btn-success">Login</button>
            </fieldset>
        </form>
    </main>

<?php
    require_once('footer.php');
    ob_flush();
?>