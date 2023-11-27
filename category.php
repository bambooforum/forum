<?php 
    

include_once('services/database.php');
$ct_category_id = $_GET['category_id'];
if(!$ct_category_id) {
    http_response_code(404);
    include('404.php');
    die();
}
$ct_query = "SELECT title FROM categories WHERE id = '$ct_category_id'";
$ct_result = $con->query($ct_query)->fetch_assoc();
if(!$ct_result) {
    http_response_code(404);
    include('404.php');
    die();

}
$ct_title = $ct_result['title'];

    include_once('services/session.php');
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'pagination' => true,
        'active_tab' => 1,
        'pagination_button_text' => 'create thread'
    ));
?>
<!DOCTYPE html>
<html>
    <?php include_once('partials/head.php') ?>
    <body>
        <div id="app">
            <?php include_once('partials/header.php') ?>
            <?php include_once('partials/tabs.php') ?>
            <main>
                <div class="route"><span>forum | <?php echo $ct_title ?></span></div>
                <h1><?php echo $ct_title ?></h1>
                <?php include_once('partials/pagination.php') ?>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
    <script>
        let categoryId = <?php echo $_GET['category_id'] ?>;
    </script>
</html>
