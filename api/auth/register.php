<?php
// explica més els errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('../../services/database.php');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);
    $password2 = addslashes($_POST['password2']);

    if ($password !== $password2) {
        echo "Els passwords no coincideixen.";
    } else {
        try {
            $query = "SELECT username FROM users WHERE username = '$username'";
            $resusername = $con->query($query);
            if ($resusername->fetch_assoc()) {
                echo "Aquest nom d'usuari ja existeix. Si us plau, tria un altre.";
            } else {
                $salt = generateRandomString(20);
                $saltedpassword = $password . $salt;
                $hashedPassword = password_hash($saltedpassword, PASSWORD_DEFAULT);
                
                $query = "INSERT INTO users (username, hash, salt) VALUES ('$username', '$hashedPassword', '$salt')";
                $con->query($query);
            
                $idquery = "SELECT id FROM users WHERE username = '$username'";
                $idresult = $con->query($idquery);
                $userid = $idresult->fetch_assoc()['id'];
                $source = '/var/www/forum/assets/img/users/default.png';
                $destination = "/var/www/forum/assets/img/users/$userid.png";
                echo 'destination: ' . $destination;
                copy( $source, $destination);

                header("Location: /login.php?source=register");
                die();
            }
        } catch (Exception $e) {
            echo "Error de connexió a la base de dades: " . $e->getMessage();
        }
    }
}
?>