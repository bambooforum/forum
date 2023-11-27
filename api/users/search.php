<?php

include_once('../../services/database.php');

$username = $_GET['username'];

$result = $con->query("SELECT username FROM users WHERE username = '$username'");

if($result && $result->num_rows > 0)
{
    header("Location: /user.php?username=$username");
    die();
}
else
{
    header("Location: /users.php?error=1");
    die();
}

?>