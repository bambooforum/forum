<?php include_once('services/lang.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1><?php echo $locals->login->title ?></h1>
            <form action="/api/auth/login.php" method="POST">
                <div class="input-container">
                    <input type="text" id="nom" placeholder="<?php echo $locals->login->username ?>" required name="name">
                </div>
                <div class="input-container">
                    <input type="password" id="password" placeholder="<?php echo $locals->login->passwd ?>" required name="password">
                </div>
                <button type="submit" class="primarybtn loginbtn"><?php echo $locals->login->btn ?></button>
            </form>
            <p class="register-link"><?php echo $locals->login->link ?> <a href="register.php"><?php echo $locals->login->register ?></a></p>
        </div>
    </div>
</body>
</html>
