<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

include_once(__DIR__ . "/../config/db.php");

class TierModel
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $this->db = getDBConnection();
    }

    // Private properties for tier details
    private $id;
    private $name;

    // Setter and getter for tier ID
    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    // Setter and getter for tier name
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    // Method to create a new tier in the database
    public function create()
    {
        $sql = 'INSERT INTO tier(name) VALUES(:name)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        return $stmt->execute();
    }

    // Method to update an existing tier in the database
    public function update()
    {
        $sql = 'UPDATE tier SET name = :name WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    // Method to delete a tier from the database
    public function delete()
    {
        $sql = 'DELETE FROM tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    // Method to fetch a specific tier by ID from the database
    public function get()
    {
        $sql = 'SELECT * FROM tier WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute(); // Executes the query
        $tier = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the tier details
        if ($tier) {
            $this->id = $tier['id'];
            $this->name = $tier['name'];
        }
        return $tier; // Returns the fetched tier data
    }

    // Method to fetch all tiers from the database
    public function getAll()
    {
        $sql = "SELECT * FROM tier";
        $stmt = $this->db->query($sql);
        $tiers = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $tiers;
    }

    // Method to fetch tiers associated with a specific service from the database
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
