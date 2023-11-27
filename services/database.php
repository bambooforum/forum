<?php
$con = null;
{
    function cdb_createdatabaseconnection() {
        $cdb_servername = "localhost";
        $cdb_username = "root";
        $cdb_password = "ipromiseimnotahacker";
        $cdb_dbname = "forum";
        // Create connection
        $cdb_con = new mysqli($cdb_servername, $cdb_username, $cdb_password, $cdb_dbname);
        return $cdb_con;
    }
    $con = cdb_createdatabaseconnection();
}

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>