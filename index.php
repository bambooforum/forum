<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

error_reporting(E_ALL);
    include_once('services/session.php');
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'active_tab' => 1
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
                <ul>
                    <?php

                    $c_query = "SELECT * FROM categories";
                    $c_result = $con->query($c_query);
                    function shorternstr(string $str) {
                                        $maxLength = 50;
                                        if(strlen($str) > $maxLength) {
                                            $str = substr($str, 0, $maxLength) . '...';
                                        } 
                                        return $str;
                                    }

                    while($c_row = $c_result->fetch_assoc()) {
                        $c_id = $c_row['id'];
                        $c_title = $c_row['title'];
                        echo "<li class=\"category\">";
                            echo "<div>";
                                echo "<h2>";
                                    echo "<button class=\"desplegable\"></button>";
                                    echo "<a href=\"/category.php?category_id=$c_id\">$c_title</a>";
                                echo "</h2>";
                                echo "<ul>";
                                    $c_t_query = "SELECT id, title FROM threads WHERE category_id = '$c_id' ORDER BY id DESC LIMIT 3";
                                    $c_t_result = $con->query($c_t_query);
                                    while($c_t_row = $c_t_result->fetch_assoc()) {
                                        $c_t_id = $c_t_row['id'];
                                        $c_t_title = $c_t_row['title'];
                                        $c_t_p_query = "SELECT text AS content FROM posts WHERE thread_id = '$c_t_id' ORDER BY id DESC LIMIT 1";
                                        $c_t_p_result = htmlspecialchars(shorternstr($con->query($c_t_p_query)->fetch_assoc()['content'] ?? ''));
                                        echo "<li class=\"thread\">";
                                        echo "<h3><a class=\"titulo-thread\" href=\"/thread.php?thread_id=$c_t_id\">$c_t_title</a></h3>";
                                        echo "<span>$c_t_p_result</span>";
                                        echo "</li>";
                                    }
                                    
                                echo "</ul>";
                            echo "</div>";
                        echo "</li>";
                    }

                    ?>
                </ul>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
</html>
