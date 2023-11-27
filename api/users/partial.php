<?php
include_once('../../services/database.php');

header('Content-Type: application/json; charset=utf-8');

$num_users = (int) $con->query('SELECT COUNT(*) AS num FROM users')->fetch_assoc()['num'];
$start = (int) $_GET['start'];
$limit = (int) $_GET['limit'];

$result = $con->query('SELECT username AS name, description, admin, signature, created_at as since, id FROM users LIMIT ' . $start . ' , ' . $limit);

$users = array();
while($row = $result->fetch_assoc()) {
    $row['admin'] = $row['admin'] == '1';
    array_push($users, $row);
}


echo json_encode(array(
    'totalCount' => $num_users,
    'count' => sizeof($users),
    'start' => $start,
    'limit' => $limit,
    'data' => $users
));

$con->close();
