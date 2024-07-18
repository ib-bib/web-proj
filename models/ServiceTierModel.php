<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

include_once(__DIR__ . "/../config/db.php");

class ServiceTierModel
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $this->db = getDBConnection();
    }

    // Private properties for service tier details
    private $id;
    private $service_id;
    private $tier_id;
    private $price;

    // Setter and getter for tier ID
    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    // Setter and getter for service ID
    public function setServiceID($s_id)
    {
        $this->service_id = $s_id;
    }

    public function getServiceID()
    {
        return $this->service_id;
    }

    // Setter and getter for tier ID
    public function setTierID($t_id)
    {
        $this->tier_id = $t_id;
    }

    public function getTierID()
    {
        return $this->tier_id;
    }

    // Setter and getter for price
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    // Method to create a new service tier in the database
    public function create()
    {
        $sql = 'INSERT INTO service_tier(service_id, tier_id, price) VALUES(:s_id, :t_id, :price)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':s_id', $this->service_id);
        $stmt->bind_param(':t_id', $this->tier_id);
        $stmt->bind_param(':price', $this->price);
        return $stmt->execute();
    }

    // Method to update an existing service tier in the database
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

    // Method to delete a service tier from the database
    public function delete()
    {
        $sql = 'DELETE FROM service_tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    // Method to fetch a specific service tier by ID from the database
    public function get()
    {
        $sql = 'SELECT * FROM service_tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute(); // Executes the query
        $service_tier = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the service tier details
        if ($service_tier) {
            $this->id = $service_tier['id'];
            $this->service_id = $service_tier['service_id'];
            $this->tier_id = $service_tier['tier_id'];
            $this->price = $service_tier['price'];
        }
        return $service_tier; // Returns the fetched service tier data
    }

    // Method to fetch all service tiers from the database
    public function getAll()
    {
        $sql = "SELECT * FROM service_tier";
        $stmt = $this->db->query($sql);
        $service_tiers = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $service_tiers;
    }

    // Method to fetch all tiers associated with a specific service from the database
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
