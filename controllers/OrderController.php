<?php
require_once __DIR__ . '/../config/db.php';

class OrderController
{
    private function createTable()
    {
        $conn = getDBConnection();

        $sql = "CREATE TABLE IF NOT EXISTS Orders (
            id BIGINT(20) UNSIGNED AUTO_INCREMENT,
            customer_email VARCHAR(255) NOT NULL,
            service_tier BIGINT(20),
            PRIMARY KEY (id),
            FOREIGN KEY (service_tier) REFERENCES Service_Tier(id)
        );";

        if ($conn->query($sql) === TRUE) {
            echo "Table Order created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $conn->close();
    }

    public function createOrder($customer_email, $service_tier)
    {
        if (filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            $conn = getDBConnection();
            $sql = "SELECT * FROM Services WHERE id = $service_tier";
            $result = $conn->query($sql);

            if (empty($service)) {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['message' => 'No services found']);
            } else {
                header('Content-Type: application/json');
                echo json_encode($service);
            }
        } else {
            // Invalid email
        }
    }

    public function updateOrder($reference_id)
    {
    }

    public function cancelOrder($reference_id)
    {
        // delete order
    }
}
