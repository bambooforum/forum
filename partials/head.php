<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORUM</title>
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/main.css">

    <?php 
        foreach($pageinfo['styles'] as $style) {
            echo "<link rel=\"stylesheet\" href=\"$style\">";
        }

        foreach($pageinfo['scripts'] as $script) {
            echo "<script src=\"$script\" defer></script>";
        }
    ?>

    
</head>
