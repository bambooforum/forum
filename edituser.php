<?php 
    include_once('services/session.php');
    if($session == '0') {
        http_response_code(401);
        include('401.php');
        die();
    }
    $queryname = addslashes($_GET['username']);
    if(!$queryname) {
        http_response_code(404);
        include('404.php');
        die();
    }

    include_once('services/database.php');

    $query = "SELECT username AS name, description, id, signature FROM users WHERE username = '$queryname'";
    $result = $con->query($query);
    $data = $result->fetch_assoc();

    $ct_query = "SELECT username FROM users WHERE username = '$queryname'";
    $ct_result = $con->query($ct_query)->fetch_assoc();
    $ct_username = $ct_result['username'];

    if(!$data) {
        //echo "user $queryname not found";
        http_response_code(404);
        include('404.php');
        die();
    }
    $name = $data['name'];
    $description = $data['description'];
    $signature = $data['signature'];
    if($sessiondata['id'] != $data['id']) {
        http_response_code(403);
        include('403.php');
        die();
    }
    include_once('services/headfiles.php');
    $pageinfo = headfiles(pathinfo(__FILE__, PATHINFO_FILENAME), array(
        'active_tab' => 2,
        'banner' => true
    ));
    $imagePath = "assets/img/users/{$sessiondata['id']}.png";
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
                <div class="route"><span>forum | users | <?php echo $ct_username ?> | edit</span></div>
                <?php
                    $saved = isset($_GET['saved']) ? 1 : 0;
                    if($saved) banner('Configuració guardada!', 'info');
                ?>
                <h1><?php echo $locals->edituser->title ?></h1>
                <form action="/api/users/edit.php" method="POST" enctype="multipart/form-data">
                    <div class="part1">
                        <div>
                            <div class="perfil-image">
                                <img id="preview" src="<?php echo $imagePath; ?>" alt="<?php echo $locals->edituser->alt_img ?>">
                            </div>
                            <label for="imagen"><?php echo $locals->edituser->img ?></label>
                            <input type="file" id="img" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="part2">
                        <?php
                            
                            echo '<input type="hidden" value="'. $data['id'] . '" name="user_id">';
                            echo '<input type="hidden" value="'. $data['name'] . '" name="user_username">';
                        ?>
                        <div>
                            <div>
                                <label for="username"><?php echo $locals->edituser->username ?> </label>
                                <input type="text" name="username" id="username" value="<?php echo $name ?>" placeholder="username">
                            </div>
                            <div class="description">
                                <label for="description"><?php echo $locals->edituser->description ?> </label>
                                <textarea name="description" id="description" placeholder="M'agrada cantar..."><?php echo $description ?></textarea>
                            </div>
                            <div class="description">
                                <label for="signature"><?php echo $locals->edituser->signature ?> </label>
                                <textarea name="signature" id="signature" placeholder="M'agrada cantar..."><?php echo $signature ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="save">
                        <button type="submit" disabled><?php echo $locals->edituser->save ?></button>
                    </div>
                </form>
            </main>
            <?php include_once('partials/footer.php') ?>
        </div>
    </body>
</html>
