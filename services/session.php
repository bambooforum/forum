<?php


session_start();
$session_started = 1;
include_once('database.php');
$token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
$s_query = "SELECT user_id FROM sessions WHERE token = '$token'";
$s_result = $con->query($s_query)->fetch_assoc();
$session = 0;
$sessiondata = array(
    'name' => '',
    'id' => ''
);
if($s_result) {
    $session = 1;
    $s_u_id = $s_result['user_id'];
    $s_u_query = "SELECT username AS name, admin FROM users WHERE id = '$s_u_id'";
    $s_u_result = $con->query($s_u_query)->fetch_assoc();
    $sessiondata['name'] = $s_u_result['name'];
    $sessiondata['id'] = $s_u_id;
    $sessiondata['admin'] = $s_u_result['admin'] ?? '0';
}
include_once('lang.php');