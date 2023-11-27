<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$queryname = isset($_GET['username']) ? addslashes($_GET['username']) : '';
if(!$queryname) {
    http_response_code(404);
    include('404.php');
    die();
}

include_once('services/database.php');

$query = "SELECT username AS name, description, id, created_at AS since FROM users WHERE username = '$queryname'";
$result = $con->query($query);
$data = $result->fetch_assoc();
if(!$data) {
    //echo "user $queryname not found";
    http_response_code(404);
    include('404.php');
    die();
}
$name = $data['name'];
$description = $data['description'];
$id = $data['id'];
$since = $data['since'];
$pquery = "SELECT text AS content, thread_id, id FROM posts WHERE author_id = $id ORDER BY id DESC LIMIT 10";
$presult = $con->query($pquery);
$posts = array();

$ct_query = "SELECT username FROM users WHERE username = '$queryname'";
$ct_result = $con->query($ct_query)->fetch_assoc();
$ct_username = $ct_result['username'];

while($row = $presult->fetch_assoc()) {
    array_push($posts, $row);
}
    include_once('services/session.php');
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'active_tab' => 2
    ));
?>
<?php


?>
<!DOCTYPE html>
<html>
    <?php include_once('partials/head.php') ?>
    <body>
        <div id="app">
            <?php include_once('partials/header.php') ?>
            <?php include_once('partials/tabs.php') ?>
            <main>
                
                <div class="route"><span>forum | users | <?php echo $ct_username ?></span></div>
                <div class="user">
                    <div class="part1">
                        <h2><?php echo $name ?></h2>
                        <img class="img" src="assets/img/users/<?php echo $id ?>.png" alt="Profile picture of <?php echo $name ?>"/>
                        <div class="numb">
                            <ul>
                                <li><?php echo $locals->user->day ?><span><?php echo date('F j, Y', strtotime($since)) ?></span></li>
                                <li><?php echo $locals->user->num_posts ?><span><?php echo count($posts) ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="part2">
                        <h2><?php echo $locals->user->title ?></h2>
                        <div class="user-tabs">
                            <ul>
                                <li class="active"><?php echo $locals->user->about_me ?></li>
                                <li><?php echo $locals->user->post ?></li>
                            </ul>
                        </div>
                        <div class="user-info">
                            <div>
                                <p><?php echo $description ?></p>
                            </div>
                            <div hidden>
                                <ul>
                                    <?php
                                    
                                    function shorternstr(string $str) {
                                        $maxLength = 50;
                                        if(strlen($str) > $maxLength) {
                                            $str = substr($str, 0, $maxLength) . '...';
                                        } 
                                        return $str;
                                    }
                                    foreach($posts as $post) {
                                        $content = htmlspecialchars(shorternstr($post['content']));
                                        $threadId = $post['thread_id'];
                                        echo "<li><a href=\"/thread.php?thread_id=$threadId\">$content</a></li>";
                                    }

                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="editbtn primarybtn" <?php
                            if($session == '0') echo 'hidden';
                            else if($sessiondata['name'] != $name) echo 'hidden';
                        ?>><a href="/edituser.php?username=<?php echo $name ?>"><?php echo $locals->user->edit ?></a></div>
                    </div>
                </div>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
</html>
