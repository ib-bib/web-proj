<?php
require_once __DIR__ . '/../config/db.php';

class OrderController
{
    public function createOrder($customer_email, $service_tier)
    {
        if (filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            $conn = getDBConnection();
            $sql = "SELECT * FROM service_tier WHERE id = $service_tier";
            $result = $conn->query($sql);

            if (empty($result)) {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['message' => 'No services found']);
            } else {
                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } else {
            // Invalid email
        }
    }
}
