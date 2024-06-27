<?php
require_once __DIR__ . '/../models/userModel.php';

class UserController
{
    public function listUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->getUsers();

        if (empty($users)) {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['message' => 'No users found']);
        } else {
            header('Content-Type: application/json');
            echo json_encode($users);
        }
    }
}
