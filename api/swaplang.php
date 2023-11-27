<?php
session_start();
$lang = isset($_GET['lang']) ? $_GET['lang'] : '';
$_SESSION['lang'] = $lang;
