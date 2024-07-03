<?php
require_once __DIR__ . '/../config/db.php';

class UserController
{
    public function listUsers()
    {
        $conn = getDBConnection();
        $sql = "SELECT id, username, email, phone FROM user";
        $result = $conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        $conn->close();

        if (empty($users)) {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['message' => 'No users found']);
        } else {
            header('Content-Type: application/json');
            echo json_encode($users);
        }
    }
}
