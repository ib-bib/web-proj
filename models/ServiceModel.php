<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

include_once(__DIR__ . "/../config/db.php");

class ServiceModel
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $this->db = getDBConnection();
    }

    // Private properties for service details
    private $id;
    private $name;
    private $description;

    // Setter and getter for service ID
    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    // Setter and getter for service name
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    // Method to create a new service in the database
    public function create()
    {
        $sql = 'INSERT INTO service(name, description) VALUES(:name, :description)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    // Method to update an existing service in the database
    public function update()
    {
        $sql = 'UPDATE service SET name = :name, description = :description WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':description', $this->description);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    // Method to delete a service from the database
    public function delete()
    {
        $sql = 'DELETE FROM service WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    // Method to fetch all services from the database
    public function getAllServices()
    {
        $sql = "SELECT * FROM service";
        return $this->db->query($sql);
    }

    // Method to fetch a specific service by ID from the database
    public function get()
    {
        $sql = 'SELECT * FROM service WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute(); // Executes the query
        $service = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the service details
        if ($service) {
            $this->id = $service['id'];
            $this->name = $service['name'];
        }
        return $service; // Returns the fetched service data
    }

    // Method to fetch all services' names and descriptions from the database
    public function getAll()
    {
        $sql = "SELECT name, description FROM service";
        $stmt = $this->db->query($sql);
        $services = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $services;
    }
}
