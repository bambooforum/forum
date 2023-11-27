<?php 
include_once('services/database.php');
$th_thread_id = $_GET['thread_id'];
if(!$th_thread_id) {
    http_response_code(404);
    include('404.php');
    die();
}
$th_query = "SELECT title, category_id FROM threads WHERE id = '$th_thread_id'";
$th_result = $con->query($th_query)->fetch_assoc();

if(!$th_result) {
    http_response_code(404);
    include('404.php');
    die();
}
$th_title = $th_result['title'];
$ct_category_id = $th_result['category_id'];
$ct_query = "SELECT title FROM categories WHERE id = '$ct_category_id'";
$ct_result = $con->query($ct_query)->fetch_assoc();
$ct_title = $ct_result['title'];


    include_once('services/session.php');
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'pagination' => true,
        'active_tab' => 1,
        'pagination_button_text' => 'reply',
        'banner' => true
    ));
?>
<!DOCTYPE html>
<html>
    <?php include_once('partials/head.php') ?>
    <body>
        <?php
            include_once('partials/popup.php');
        ?>
        <div id="app">
            <?php include_once('partials/header.php') ?>
            <?php include_once('partials/tabs.php') ?>
            <main>
                <div class="route"><span>forum | <?php echo $ct_title ?> | <?php echo $th_title ?></span></div>
                <?php
                    include_once('partials/banner.php');
                    $error = $_GET['error'] ?? '0';
                    if($error == '6') {
                        banner($locals->thread->banner, 'danger');
                    } 
                ?>
                <h1><?php echo $th_title ?></h1>
                <?php include_once('partials/pagination.php') ?>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
        
        <script>
            let threadId = <?php echo $_GET['thread_id'] ?>;
        </script>
    </body>
</html>    
