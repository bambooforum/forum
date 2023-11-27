<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('../../services/session.php');
include_once('../../services/database.php');

function createThread($con, $title, $authorId, $categoryId) {
    $ct_query_1 = "INSERT INTO threads (author_id, title, category_id) VALUES ('$authorId', '$title', '$categoryId')";
    $ct_query_2 = "SELECT LAST_INSERT_ID() AS id" ;
    $con->query($ct_query_1);
    return $con->query($ct_query_2)->fetch_assoc()['id'];
}
function createPost($con, $content, $authorId, $threadId) {

    $cp_query_1 = "INSERT INTO posts (author_id, text, thread_id) VALUES ('$authorId', '$content', '$threadId')";
    $cp_query_2 = "SELECT LAST_INSERT_ID() AS id" ;
    $con->query($cp_query_1);
    return $con->query($cp_query_2)->fetch_assoc()['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($session == '0') {
        header('Location: /login.php?redirect=/createthread.php');
        die();
    }

    $title = addslashes($_POST['title']);
    $content = addslashes($_POST['content'] ?? '<empty>');
    $authorId = addslashes($sessiondata['id']);
    $categoryId = addslashes($_POST['category_id']);
    
    $threadId = createThread($con, $title, $authorId, $categoryId);
    $postId = createPost($con, $content, $authorId, $threadId);

    header("Location: /thread.php?thread_id=$threadId");
    die();
}
