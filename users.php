<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    include_once('services/session.php');
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'pagination' => true,
        'active_tab' => 2,
        'pagination_double' => true,
        'banner' => true
    ));
    include_once('partials/banner.php');

?>
<!DOCTYPE html>
<html>
    <?php include_once('partials/head.php') ?>
    <body>
        <div id="app">
            <?php include_once('partials/header.php') ?>
            <?php include_once('partials/tabs.php') ?>
            <main>
                <div class="route"><span>forum | users</span></div>
                <?php
                    $error = $_GET['error'] ?? '0';
                    if($error == '1') {
                        banner('user does not exist', 'danger');
                    }
                ?>
                <h1><?php echo $locals->users->title ?></h1>
                <form action="/api/users/search.php" class="search-bar" method="GET">
                    <input type="text" id="searchInput" placeholder="Search..." name="username">
                    <button type="submit" class="search-button">
                        <img src="assets/img/lupa.png" alt="Botón de búsqueda">
                    </button>
                </form>
                <?php include_once('partials/pagination.php') ?>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
</html>
