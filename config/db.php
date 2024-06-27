<?php

$host = 'localhost';
$db = 'project_db';
$user = 'root';
$pass = '';

function getDBConnection()
{
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
