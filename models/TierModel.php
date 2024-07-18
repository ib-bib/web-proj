<?php
include_once(__DIR__ . "/../config/db.php");
class TierModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    private $id;
    private $name;

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function create()
    {
        $sql = 'INSERT INTO tier(name) VALUES(:name)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE tier SET name = :name WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $sql = 'DELETE FROM tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    public function get()
    {
        $sql = 'SELECT * FROM tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
        $tier = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($tier) {
            $this->id = $tier['id'];
            $this->name = $tier['name'];
        }
        return $tier;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM tier";
        $stmt = $this->db->query($sql);
        $tiers = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $tiers;
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
