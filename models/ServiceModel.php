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
        $sql = 'INSERT INTO service(name, description) VALUES(:name, :description)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE service SET name = :name, description = :description WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':name', $this->name);
        $stmt->bind_param(':description', $this->description);
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

    public function getAllServices()
    {
        $sql = "SELECT * FROM service";
        return $this->db->query($sql);
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
