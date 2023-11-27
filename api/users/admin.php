<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include_once('../../services/session.php');
include_once('../../services/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = $sessiondata['admin'];

    if(!$admin) {
        http_response_code(403);
        header('Content-Type: application/json');
        echo '{"code":403}';
        die();
    }

    $username = $_POST['name'] ?? '';
    $action = $_POST['action'] ?? 'remove';

    $actionv = strcmp($action, 'promote') ? 'false' : 'true';

    if(!$username) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo "{\"code\":400,\"name\":\"$username\"}";
        die();
    }

    echo $username . $action . $actionv;

    $ue_query = "SELECT id, admin FROM users WHERE username = '$username'";
    $ue_result = $con->query($ue_query)->fetch_assoc();

    if(!$ue_result) {
        http_response_code(404);
        header('Content-Type: application/json');
        echo '{"code":404}';
        die();
    }

    $u_query = "UPDATE users SET admin = $actionv WHERE username = '$username'";
    $con->query($u_query);
}