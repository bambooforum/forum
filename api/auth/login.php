<?php
session_start();
include_once('../../services/database.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function createSession($userid) {
    $token = bin2hex(random_bytes(10));
    return $token;
}

$name = isset($_POST['name']) ? addslashes($_POST['name']) : null;
$password = isset($_POST['password']) ? addslashes($_POST['password']) : null;

echo $name . $password . '<br>';

if (!empty($name) && !empty($password)) {
    $sql = "SELECT salt, hash, id FROM users WHERE username = '$name'";
    $result = $con->query($sql)->fetch_assoc();
    $salt = $result['salt'];
    $hash = $result['hash'];
    $id = $result['id'];

    echo $salt . $hash . 'idk';

    $saltedpassword = $password . $salt;

    if (password_verify($saltedpassword, $hash)) {
        $sessiontoken = createSession($id);
        $savesql = "INSERT INTO sessions (user_id, token) VALUES ($id, '$sessiontoken')";
        $con->query($savesql);
        $_SESSION['token'] = $sessiontoken;
        header("Location: /user.php?username=$name");
        die();
    } else {
        header("Location: /login.php?error=1");
        die();
    }
}
else {
    header("Location: /login.php?error=2");
    die();
}

$con->close();

?>
