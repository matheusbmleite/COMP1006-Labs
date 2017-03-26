<?php
require_once('auth.php');
try {
    //checking if the file has been selected
    if(!empty($_FILES['logo']['name'])) {
        $name = $_FILES['logo']['name'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        $error = '';

        //testing if the upload file is a gif, jpeg or png
        $valid_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
        $file_type = exif_imagetype($tmp_name);
        $wrong_type = !in_array($file_type, $valid_types);

        //checking if the file is valid
        if(!empty($wrong_type)) {
            $error .= 'The logo must be a gif, png or jpg file. </br>';
        }
        if($_FILES['logo']['size'] > 2048000) {
            $error .= 'The logo must be less than 2MB. </br>';
        }

        //if the file is valid, move to the server and redirect the page
        if(empty($error)) {
            //deleting the previous logo
            $images = glob('logo/*');
            unlink($images[0]);

            //moving the new logo to the server and redirecting the page
            move_uploaded_file($tmp_name, "logo/".$name);
            header('location:admin-panel.php');
        } else {
            header('location:upload-logo.php?error='.$error);
        }

    } else {
        $error .= 'You must select a file </br>';
        header('location:upload-logo.php?error='.$error);
    }
//If an exception ocurred, redirect to the error page and email me
} catch(exception $e) {
    mail('matheusbmleite@gmail.com', 'process-upload logo error', $e);
    header('location:error.php');
}
?>