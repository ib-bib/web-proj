<?php
/* Author Talal
Created: June 19th
Modified: June 19th
*/

// Configuration array for database connection details
$config = array();

// Database user
$config["db_user"] = "webproju";
// Database password
$config["db_pass"] = "pass123";
// Database name
$config["db_name"] = "project_db";
// Database host
$config["db_host"] = "localhost";

// Function to get a database connection
function getDBConnection()
{
    global $config;
    // Create a new mysqli connection using the configuration details
    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    // Check for connection errors
    if ($conn->connect_error) {
        // If connection failed, terminate script and display error message
        die("Connection failed: " . $conn->connect_error);
    }
    // Return the connection object if successful
    return $conn;
}
