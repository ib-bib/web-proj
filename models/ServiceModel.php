<?php
include_once(__DIR__ . "/../config/db.php");
class ServiceModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    private $id;
    private $name;
    private $description;
    // private $images;

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
        $sql = 'INSERT INTO service(name) VALUES(:name)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE service SET name = :name WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $sql = 'DELETE FROM service WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    public function get()
    {
        $sql = 'SELECT * FROM service WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($service) {
            $this->id = $service['id'];
            $this->name = $service['name'];
        }
        return $service;
    }

    public function getAll()
    {
        $sql = "SELECT name, description FROM service";
        $stmt = $this->db->query($sql);
        $services = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $services;
    }
}

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
}

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
        $sql = 'INSERT INTO service_tier(service_id, tier_id, price) VALUES(:s_id, t_id, price)';
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
}
