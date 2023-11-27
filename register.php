<?php include_once('services/lang.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1><?php echo $locals->register->title ?></h1>
            <form action="/api/auth/register.php" method="POST">
                <div class="input-container">
                    <input type="text" id="username" placeholder="<?php echo $locals->register->username ?>" required name="username">
                </div>
                <div class="input-container">
                    <input type="password" id="password" placeholder="<?php echo $locals->register->pass ?>" required name="password">
                </div>
                <div class="input-container">
                    <input type="password" id="password2" placeholder="<?php echo $locals->register->pass2 ?>" required name="password2">
                </div>
                <button type="submit" class="primarybtn loginbtn"><?php echo $locals->register->btn ?></button>
            </form>
            <p class="login-link"><?php echo $locals->register->link ?> <a href="login.php"><?php echo $locals->register->login ?></a></p>
        </div>
    </div>
</body>
</html>
