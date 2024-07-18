<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

include_once(__DIR__ . "/../config/db.php");

class OrderModel
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $this->db = getDBConnection();
    }

    // Private properties for order details
    private $id;
    private $service_tier_id;
    private $client_email;
    private $status;
    private $reference_id;

    // Setters and getters for order properties
    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setServiceTierID($st_id)
    {
        $this->service_tier_id = $st_id;
    }

    public function getServiceTierID()
    {
        return $this->service_tier_id;
    }

    public function setClientEmail($email)
    {
        $this->client_email = $email;
    }

    public function getClientEmail()
    {
        return $this->client_email;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setReferenceID($ref_id)
    {
        $this->reference_id = $ref_id;
    }

    public function getReferenceID()
    {
        return $this->reference_id;
    }

    // Fetch all services, tiers, and service tiers from the database
    public function getServicesAndTiers()
    {
        $services = [];
        $tiers = [];
        $serviceTiers = [];

        // Fetch services
        $sql = "SELECT id, name, description FROM service";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }

        // Fetch tiers
        $sql = "SELECT id, name FROM tier";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $tiers[] = $row;
        }

        // Fetch service tiers
        $sql = "SELECT id, service_id, tier_id, price FROM service_tier";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $serviceTiers[] = $row;
        }

        return ['services' => $services, 'tiers' => $tiers, 'serviceTiers' => $serviceTiers];
    }

    // Create a new order in the database
    public function createOrder($serviceTierId, $clientEmail, $ref_id)
    {
        $status = 'pending';

        // Prepare and execute the insert statement
        $stmt = $this->db->prepare("INSERT INTO service_order (client_email, status, reference_id, service_tier_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $clientEmail, $status, $ref_id, $serviceTierId);
        if ($stmt->execute()) {
            return $ref_id; // Return the reference ID on success
        } else {
            return false; // Return false on failure
        }
    }

    // Track an order by its reference ID
    public function trackOrder($orderRef)
    {
        $query = "SELECT id, status FROM service_order WHERE reference_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $orderRef);
        $stmt->execute();
        $result = $stmt->get_result();

        // Return order details if found
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false; // Return false if order not found
        }
    }

    // Cancel an order by its ID
    public function cancelOrder($orderId)
    {
        $query = "UPDATE service_order SET status = 'cancelled' WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $orderId);
        $result = $stmt->execute();

        return $result; // Return the result of the update operation
    }
}
