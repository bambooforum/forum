<?php
if(!$session_started) session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ca';
$localsfilepath = realpath("../locals/$lang.json");
$localsfile = file_get_contents(__DIR__ . "/../locals/$lang.json");
$locals = json_decode($localsfile);