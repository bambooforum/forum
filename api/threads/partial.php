<?php
include_once('../../services/database.php');

header('Content-Type: application/json; charset=utf-8');

$start = (int) $_GET['start'];
$limit = (int) $_GET['limit'];
$category_id = $_GET['category_id'];
$num_threads = (int) $con->query('SELECT COUNT(*) AS num FROM threads WHERE category_id = ' . "'$category_id'")->fetch_assoc()['num'];

$result = $con->query('SELECT author_id AS authorId, title as title, created_at AS createdAt, id FROM threads WHERE category_id = ' . "'$category_id'" . ' LIMIT ' . $start . ' , ' . $limit);

$threads = array();
while($row = $result->fetch_assoc()) {
    $uid = $row['authorId'];
    $uresult = $con->query("SELECT username AS name, signature FROM users WHERE id = '$uid'")->fetch_assoc();
    $uname = $uresult['name'];
    $usignature = $uresult['signature'];
    $row['signature'] = $usignature;
    $row['authorName'] = $uname;
    $pid = $row['id'];
    $pcontent = $con->query("SELECT text AS content FROM posts WHERE thread_id = '$pid' ORDER BY id DESC LIMIT 1")->fetch_assoc()['content'];
    $row['text'] = $pcontent;
    array_push($threads, $row);
}


echo json_encode(array(
    'totalCount' => $num_threads,
    'count' => sizeof($threads),
    'start' => $start,
    'limit' => $limit,
    'categoryId' => $category_id,
    'data' => $threads
));
