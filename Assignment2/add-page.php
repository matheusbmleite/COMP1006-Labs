<?php
$pageTitle = 'Add Page';
require_once('header.php');
require_once('auth.php');

$pageId = null;
$title = null;
$content = null;


//checking the url for an albumId, in case the user clicked the edit button
try {
    if(!empty($_GET['pageId'])) {
        if(is_numeric($_GET['pageId'])) {
            $pageId = $_GET['pageId'];

            require_once('db.php');

            $sql = "SELECT title, content FROM pages WHERE pageId=:pageId;";
            $cmd = $connection->prepare($sql);
            $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
            $cmd->execute();
            $page = $cmd->fetch();

            $title = $page['title'];
            $content = $page['content'];

            $connection = null;

        }
    }
} catch(exception $e) {
    mail('matheusbmleite@gmail.com', 'add-page error', $e);
    header('location:error.php');
}
?>

    <main class="container">
        <h1>Add Page</h1>
        <?php
        $error = $_GET['error'];
        //changing the alert message according to the error variable
        if(!empty($error)) {
            echo '<div class="alert alert-danger" id="message">' . $error . '</div>';
        }
        ?>
        <form method="post" action="process-add-page.php" enctype="multipart/form-data">
            <fieldset class="form-group">
                <label for="title" class="col-sm-1">Title: </label>
                <input name="title" id="title" placeholder="Page title" value="<?php echo $title; ?>" required/>
            </fieldset>
            <fieldset class="form-group">
                <label for="content" class="col-sm-1">Content: </label>
                <textarea name="content" id="content" placeholder="insert the content of your page here" cols="100"
                          rows="10"><?php echo $content; ?></textarea>
            <input name="pageId" id="pageId" value="<?php echo $pageId; ?>" type="hidden"/>
            <button class="btn btn-danger col-sm-offset-0">Save Page</button>
        </form>
    </main>

<?php
require_once('footer.php');
?>