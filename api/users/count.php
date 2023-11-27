<?php
include_once('../../services/database.php');

header('Content-Type: application/json; charset=utf-8');

$num_users = (int) $con->query('SELECT COUNT(*) AS num FROM users')->fetch_assoc()['num'];

echo json_encode($num_users);

$con->close();
