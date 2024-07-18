<?php
include_once(__DIR__ . "/../config/db.php");
class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    private $id;
    private $service_tier_id;
    private $client_email;
    private $status;
    private $reference_id;

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

    public function getServicesAndTiers()
    {
        $services = [];
        $tiers = [];
        $serviceTiers = [];

        $sql = "SELECT id, name, description FROM service";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }

        $sql = "SELECT id, name FROM tier";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $tiers[] = $row;
        }

        $sql = "SELECT id, service_id, tier_id, price FROM service_tier";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $serviceTiers[] = $row;
        }

        return ['services' => $services, 'tiers' => $tiers, 'serviceTiers' => $serviceTiers];
    }

    public function createOrder($serviceTierId, $clientEmail, $ref_id)
    {
        $status = 'pending';

        $stmt = $this->db->prepare("INSERT INTO service_order (client_email, status, reference_id, service_tier_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$clientEmail, $status, $ref_id, $serviceTierId]);
    }

    public function trackOrder($orderRef)
    {
        $query = "SELECT id, status FROM service_order WHERE reference_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $orderRef);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function cancelOrder($orderId)
    {
        $query = "UPDATE service_order SET status = 'cancelled' WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $orderId);
        $result = $stmt->execute();

        return $result;
    }
}
