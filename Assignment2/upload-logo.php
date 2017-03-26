<?php
require_once('auth.php');
$pageTitle = 'Upload Logo';
require_once('header.php');


?>

    <main class="container">
        <h1>Upload your logo</h1>
        <?php
        $error = $_GET['error'];
        //changing the alert message according to the error variable
        if(!empty($error)) {
            echo '<div class="alert alert-danger" id="message">'.$error.'</div>';
        } else {
            echo '<div class="alert alert-success" id="message">It is recommended that you use a png file.</div>';
        }
        ?>
        <form method="post" action="process-upload-logo.php" enctype="multipart/form-data">
            <fieldset class="form-group">
                <label for="logo" class="col-sm-2">Choose logo: </label>
                <input name="logo" type="file"/>
            </fieldset>
                <button class="btn btn-danger col-sm-offset-0">Upload</button>
        </form>
    </main>

<?php
require_once('footer.php');
?>