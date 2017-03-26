<?php
//Setting the pageTitle variable for the heading
$pageTitle = '';
//requiring the heading
require_once('header.php');
?>

<main class="container">

    <?php
    $page_id = $_GET['id'];
    try {
        //getting the page from the database
        $sql = "SELECT * FROM pages WHERE pageId = :id;";
        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();

        //a little js to change the title of the current page
        echo '<script>document.title = "'.$page['title'].'";</script>';

        //populating the page with its content
        echo '<h1>' . $page['title'] . '</h1><p>' . $page['content'] . '</p>';

        //In case of an exception, redirect to the error page and email me
    } catch (exception $e) {
        mail('matheusbmleite@gmail.com', 'retrieving page from database error', $e);
        header('location:error.php');
    }

    ?>
</main>

<?php
//requiring the footer
require_once('footer.php');
?>
