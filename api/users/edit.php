<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once('../../services/database.php');
    include_once('../../services/session.php');

    if($session == '0') {
        http_response_code(401);
        include('../../401.php');
        die();
    }

    $uid = $_POST['user_id'];

    if($sessiondata['id'] != $uid) {
        http_response_code(403);
        include('../../403.php');
        die();
    }

    if (!$uid) {
        echo "No username";
        die();
    }

    if (isset($_FILES["image"])) {

        $userid = $sessiondata['id'];
        $target_dir = "/var/www/forum/assets/img/users/";
        $target_file = $target_dir . "$userid.png";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(!$_FILES["image"]["tmp_name"]) goto endimg; // <3
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            unlink($target_file);
            
        }

        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    } else {
        echo "No se ha seleccionado ningún archivo.";
    }
    endimg:
    

    $newUsername = $_POST['username'];

    $query = "UPDATE users SET username = '$newUsername' WHERE id = '$uid'";
    $result = $con->query($query);
    if ($result) {
        echo "Username actualitzada amb èxit!";
        header("Location: /edituser.php?username=$newUsername&saved");
    } else {
        echo "Error en l'actualització del nom d'usuari: " . $con->error;
        $username = "";
        $username = addslashes($_POST['user_username']);
        header("Location: /edituser.php?username=$username&saved");
    }


    $newDescription = addslashes($_POST['description']);

    $query = "UPDATE users SET description = '$newDescription' WHERE id = '$uid'";
    $result = $con->query($query);
    if ($result) {
        echo "Descripció actualitzada amb èxit! <br>";
    } else {
        echo "Error en l'actualització de la descripció: " . $con->error;
    }


    $newSignature = addslashes($_POST['signature']);

    $query = "UPDATE users SET signature = '$newSignature' WHERE id = '$uid'";
    $result = $con->query($query);
    if ($result) {
        echo "Signatura actualitzada amb èxit!";
    } else {
        echo "Error en l'actualització de la signatura: " . $con->error;
    }
 
    die(); 
}
?>
