<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include_once('../../services/session.php');
include_once('../../services/database.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($session == '1') {
    $d_query = "DELETE FROM sessions WHERE token = '$token'";
    try {
        $con->query($d_query);
        header("Location: /");
        die();
    } catch(Exception $e) {
        header("Location: /login.php?error=4");
        die();
    }
    
}
else {
    header("Location: /login.php?error=3");
    die();
}

$con->close();

?>
