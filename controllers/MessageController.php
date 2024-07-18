<?php
include_once(__DIR__ . "/../" . "config/db.php");

function addMessage($subject, $message, $email) {
    $dbc = getDBConnection();

    $cemail = $dbc->real_escape_string($email);
    $csubject = $dbc->real_escape_string($subject);
    $cmessage = $dbc->real_escape_string($message);

    // insert data to database
    $sql = "INSERT INTO messages (email, subject, message) VALUES ('" . $cemail . "', '" . $csubject . "', '" . $cmessage . "')";
    $res = $dbc->query($sql);
    return $res;
}