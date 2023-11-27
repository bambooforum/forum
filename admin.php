<?php 
    include_once('services/session.php');
    
    if($session == '0') {
        http_response_code(401);
        include('401.php');
        die();
    }
    if($sessiondata['admin'] != '1') {
        http_response_code(403);
        include('403.php');
        die();
    }
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'pagination' => true,
        'active_tab' => 3
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
                <div class="route"><span>forum | admin panel</span></div>
                <h1>Admin</h1>
                <h2>Manage categories <button class="primarybtn">add</button></h2> 
                <ul id="categories">
                    <?php
                    $c_query = "SELECT * FROM categories";
                    $c_result = $con->query($c_query);


                    while($c_row = $c_result->fetch_assoc()) {
                        $title = $c_row['title'];
                        echo "<li><span class=\"item-name\">$title</span><div><button class=\"secondarybtn\">edit</button><button class=\"dangerbtn\">remove</button></div></li>";
                    }

                    ?>
                </ul>
                <h2>Manage users</h2>
                <form action="/api/users/admin.php" method="POST" id="user-form">
                    <label for="i_a_name">Username: </label>
                    <input type="text" name="name" id="i_a_name">
                    <input type="submit" value="promote" name="action" class="primarybtn">
                    <input type="submit" value="remove" name="action" class="primarybtn">
                </form>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
</html>
