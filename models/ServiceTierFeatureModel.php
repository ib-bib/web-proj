<?php
include_once(__DIR__ . "/../config/db.php");
class ServiceTierFeatureModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    private $id;
    private $service_tier_id;
    private $description;

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

    public function setDescription($desc)
    {
        $this->description = $desc;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function create()
    {
        $sql = 'INSERT INTO service_tier_feature (service_tier_id, description) VALUES(:st_id, :description)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':st_id', $this->service_tier_id);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE service_tier_feature SET service_tier_id = :st_id, description = :description WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        $stmt->bind_param(':st_id', $this->service_tier_id);
        $stmt->bind_param(':description', $this->description);
        return $stmt->execute();
    }

    public function delete()
    {
        $sql = 'DELETE FROM service_tier_feature WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
    }

    public function get()
    {
        $sql = 'SELECT * FROM service_tier_feature WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(':id', $this->id);
        return $stmt->execute();
        $service_tier_feature = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($service_tier_feature) {
            $this->id = $service_tier_feature['id'];
            $this->service_tier_id = $service_tier_feature['service_tier_id'];
            $this->description = $service_tier_feature['description'];
        }
        return $service_tier_feature;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM service_tier_feature";
        $stmt = $this->db->query($sql);
        $service_tier_features = $stmt->fetch_all(PDO::FETCH_ASSOC);
        return $service_tier_features;
    }

    public function getFeaturesByServiceTierId($serviceTierId)
    {
        $sql = "SELECT description FROM service_tier_feature WHERE service_tier_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $serviceTierId);
        $stmt->execute();
        return $stmt->get_result();
    }
}
