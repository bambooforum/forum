<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 

$query = addslashes("hi';DROP TABLE users;SELECT * FROM threads where id = '1");
echo "SELECT * FROM users WHERE username = '$query'";