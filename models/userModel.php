<?php
require_once __DIR__ . '/../config/db.php';

class UserModel
{
    public function getUsers()
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
        return $users;
    }
}
