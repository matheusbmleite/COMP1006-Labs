<?php
ob_start();
//requiring that the user is authenticated
require_once('auth.php');

    try{
        //storing the form inputs into variables
        $pageId = $_POST['pageId'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $error = "";
        //variable to indicate if there are 1 or more errors
        $ok = true;

        // validating the inputs before saving
        if(empty($title)) {
            $error .= 'The title of the page is required<br />';
            $ok = false;
        }
        if(empty($content)) {
            $error .= 'The content of the page is required<br />';
            $ok = false;
        }

        if($ok) {
            require_once('db.php');

            //setting up an SQL instruction to save a new page or to update an existing one
            if(empty($pageId)) {
                $sql = "INSERT INTO pages(title, content) VALUES (:title, :content);";
            } else {
                $sql = "UPDATE pages SET title = :title, content = :content WHERE pageId = :pageId;";
            }


            //preparing the sql command, binding the parameters and executing the query
            $cmd = $connection->prepare($sql);
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 255);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR, 1000);

            //If we are updating an existing page, we are going to need the pageId binded
            if(!empty($pageId)) {
                $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
            }

            $cmd->execute();

            //disconnecting
            $connection = null;

            //    redirecting the user to another page
            header('location:pages.php');
        }
         else {
            header('location:add-page.php?error='.$error);
         }
    }
   //In case of an exception, redirect to the error page and email me
    catch(exception $e) {
        mail('matheusbmleite@gmail.com', 'process-add page error', $e);
        header('location:error.php');
    }

 ob_flush();
?>