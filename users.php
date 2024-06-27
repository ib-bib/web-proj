<?php
header('Content-Type: application/json');

// SQL query to fetch all users
$sql = "SELECT id, username, email, phone FROM user";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo json_encode(['message' => 'No users found']);
    exit();
}

// Close connection
$conn->close();

// Return users as JSON
echo json_encode($users);
