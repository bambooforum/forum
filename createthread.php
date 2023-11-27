<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('services/database.php');
$category_id = $_GET['category_id'];

$query = "SELECT id FROM categories WHERE id = '$category_id'";
$result = $con->query($query)->fetch_assoc();
$category = $result['id'];

include_once('services/session.php');
include_once('services/headfiles.php');
$pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
    'active_tab' => 1
));

if($session == '0') {
    header('Location: /login.php?redirect=/createthread.php');
    die();
}
?>
<!DOCTYPE html>
<html>
    <?php include_once('partials/head.php') ?>
    <body>
        <div id="app">
            <?php include_once('partials/header.php') ?>
            <?php include_once('partials/tabs.php') ?>
            <main>
                <div class="route"><span>forum | create thread </span></div>
                <h1><?php echo $locals->createthread->title ?></h1>
                <form action="/api/threads/new.php" method="POST">
                    <div class="thread-wrapper"> 
                        <div class="title">
                            <label for="threadtitle"><?php echo $locals->createthread->thread ?></label>
                            <input name="title" id="threadtitle" placeholder="New Title" required></br>
                        </div>
                        <div class="catofpost">
                            <label for="category"><?php echo $locals->createthread->category ?></label>
                            <select name="category_id" id="category" class="secondarybtn" required>
                                <?php
                                $c_query = "SELECT id, title FROM categories";
                                $c_result = $con->query($c_query);
                                while($row = $c_result->fetch_assoc()) {
                                    $id = $row["id"];
                                    $title = $row["title"];
                                    echo "<option value=\"$id\" " . ($id == $category ? "selected" : "") . ">$title</option>";

                                }
                                ?>
                            </select> 
                        </div>
                        <div class="post">
                            <label for="firstpost"><?php echo $locals->createthread->post ?></label>
                            <textarea name="content" id="firstpost" required></textarea>
                        </div>
                        <div class="btncreate">
                            <input type="hidden" name="author_id" value=""/>
                            <button type="submit" class="primarybtn"><?php echo $locals->createthread->submit ?></button>
                        </div>
                    </div>
                </form>        
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
</html>    
