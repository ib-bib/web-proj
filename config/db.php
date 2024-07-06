<?php

require_once( __DIR__ . "/../include/config.php");

function getDBConnection()
{
    global $config;
    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
