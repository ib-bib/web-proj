<?php

$config = array();

// $config["db_user"] = "thedoctor";
// $config["db_pass"] = "tardis";
// $config["db_name"] = "webproj";
// $config["db_host"] = "127.0.0.1";
$config["db_user"] = "root";
$config["db_pass"] = "";
$config["db_name"] = "project_db";
$config["db_host"] = "localhost";

function getDBConnection()
{
    global $config;
    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
