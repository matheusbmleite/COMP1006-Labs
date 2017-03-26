<?php
//Setting the pageTitle variable for the heading
$pageTitle = 'Administrator Panel';
//requiring the heading
require_once('header.php');
//requiring that the user is authenticated
require_once('auth.php');
?>

<main class="container">
    <div class="btn-group btn-group-justified" role="group" aria-label=" Buttons ">
        <a href="admins.php" class="btn btn-danger">Manage Administrators</a>
        <a href="pages.php" class="btn btn-danger">Manage Pages</a>
        <a href="add-page.php" class="btn btn-danger">Add Page</a>
        <a href="upload-logo.php" class="btn btn-danger">Upload Logo</a>
    </div>
</main>

<?php
//requiring the footer
require_once('footer.php');
?>
