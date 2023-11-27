<?php
include_once('../../services/database.php');

header('Content-Type: application/json; charset=utf-8');

$thread_id = $_GET['thread_id'];
$num_posts = (int) $con->query('SELECT COUNT(*) AS num FROM posts WHERE thread_id = ' . "'$thread_id'")->fetch_assoc()['num'];
$start = (int) $_GET['start'];
$limit = (int) $_GET['limit'];

$result = $con->query('SELECT author_id AS authorId, text as content, created_at AS createdAt, \'signature\' FROM posts WHERE thread_id = ' . "'$thread_id'" . ' LIMIT ' . $start . ' , ' . $limit);
$posts = array();
while($row = $result->fetch_assoc()) {
    $uid = $row['authorId'];
    $uresult = $con->query("SELECT username AS name, signature FROM users WHERE id = '$uid'")->fetch_assoc();
    $uname = $uresult['name'];
    $usignature = $uresult['signature'];
    $row['signature'] = $usignature;
    $row['authorName'] = $uname;
    array_push($posts, $row);
}


echo json_encode(array(
    'totalCount' => $num_posts,
    'count' => sizeof($posts),
    'start' => $start,
    'limit' => $limit,
    'threadId' => $thread_id,
    'data' => $posts
));

$con->close();
