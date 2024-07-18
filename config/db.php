<?php

$config = array();

$config["db_user"] = "webproju";
$config["db_pass"] = "pass123";
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
