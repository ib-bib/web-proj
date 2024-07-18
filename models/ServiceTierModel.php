<?php
include_once(__DIR__ . "/../config/db.php");
class ServiceTierModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    private $id;
    private $service_id;
    private $tier_id;
    private $price;

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setServiceID($s_id)
    {
        $this->service_id = $s_id;
    }

    public function getServiceID()
    {
        return $this->service_id;
    }

    public function setTierID($t_id)
    {
        $this->service_id = $t_id;
    }

    public function getTierID()
    {
        return $this->tier_id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function create()
    {
        $sql = 'INSERT INTO service_tier(service_id, tier_id, price) VALUES(:s_id, :t_id, :price)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':s_id', $this->service_id);
        $stmt->bind_param(':t_id', $this->tier_id);
        $stmt->bind_param(':price', $this->price);
        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE service_tier SET service_id = :s_id, tier_id = :t_id, price = :price WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        $stmt->bind_param(':s_id', $this->service_id);
        $stmt->bind_param(':t_id', $this->tier_id);
        $stmt->bind_param(':price', $this->price);
        return $stmt->execute();
    }

    public function delete()
    {
        $sql = 'DELETE FROM service_tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    public function get()
    {
        $sql = 'SELECT * FROM service_tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
        $service_tier = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($service_tier) {
            $this->id = $service_tier['id'];
            $this->service_id = $service_tier['service_id'];
            $this->tier_id = $service_tier['tier_id'];
            $this->price = $service_tier['price'];
        }
        return $service_tier;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM service_tier";
        $stmt = $this->db->query($sql);
        $service_tiers = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $service_tiers;
    }

    public function getTiersByServiceId($serviceId)
    {
        $sql = "SELECT tier.id, tier.name, service_tier.price 
                FROM tier 
                JOIN service_tier ON tier.id = service_tier.tier_id 
                WHERE service_tier.service_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $serviceId);
        $stmt->execute();
        return $stmt->get_result();
    }
}
