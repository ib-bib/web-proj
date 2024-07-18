<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

include_once(__DIR__ . "/../config/db.php");

class ServiceImageModel
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $this->db = getDBConnection();
    }

    // Private properties for image details
    private $id;
    private $service_id;
    private $image_url;
    private $image_name;

    // Setters and getters for image properties
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

    public function setImageURL($image_url)
    {
        $this->image_url = $image_url;
    }

    public function getImageURL()
    {
        return $this->image_url;
    }

    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }

    public function getImageName()
    {
        return $this->image_name;
    }

    // Fetch images by service ID from the database
    public function getImagesByServiceId($serviceId)
    {
        $sql = "SELECT * FROM service_images WHERE service_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $serviceId);
        $stmt->execute();
        return $stmt->get_result(); // Return the result set of the query
    }
}
