<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

include_once(__DIR__ . "/../config/db.php");

class ServiceTierFeatureModel
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $this->db = getDBConnection();
    }

    // Private properties for service tier feature details
    private $id;
    private $service_tier_id;
    private $description;

    // Setter and getter for feature ID
    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    // Setter and getter for service tier ID
    public function setServiceTierID($st_id)
    {
        $this->service_tier_id = $st_id;
    }

    public function getServiceTierID()
    {
        return $this->service_tier_id;
    }

    // Setter and getter for feature description
    public function setDescription($desc)
    {
        $this->description = $desc;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Method to create a new service tier feature in the database
    public function create()
    {
        $sql = 'INSERT INTO service_tier_feature (service_tier_id, description) VALUES(:st_id, :description)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':st_id', $this->service_tier_id);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    // Method to update an existing service tier feature in the database
    public function update()
    {
        $sql = 'UPDATE service_tier_feature SET service_tier_id = :st_id, description = :description WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        $stmt->bind_param(':st_id', $this->service_tier_id);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    // Method to delete a service tier feature from the database
    public function delete()
    {
        $sql = 'DELETE FROM service_tier_feature WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    // Method to fetch a specific service tier feature by ID from the database
    public function get()
    {
        $sql = 'SELECT * FROM service_tier_feature WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute(); // Executes the query
        $service_tier_feature = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the feature details
        if ($service_tier_feature) {
            $this->id = $service_tier_feature['id'];
            $this->service_tier_id = $service_tier_feature['service_tier_id'];
            $this->description = $service_tier_feature['description'];
        }
        return $service_tier_feature; // Returns the fetched feature data
    }

    // Method to fetch all service tier features from the database
    public function getAll()
    {
        $sql = "SELECT * FROM service_tier_feature";
        $stmt = $this->db->query($sql);
        $service_tier_features = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $service_tier_features;
    }

    // Method to fetch all feature descriptions for a specific service tier from the database
    public function getFeaturesByServiceTierId($serviceTierId)
    {
        $sql = "SELECT description FROM service_tier_feature WHERE service_tier_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $serviceTierId);
        $stmt->execute();
        return $stmt->get_result();
    }
}
