<?php
include_once(__DIR__ . "/../models/ServiceModel.php");
class ServiceController
{
    private $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }

    public function show($id)
    {
        $service = $this->serviceModel->get($id);
        if ($service) {
        } else {
            echo "Service not found.";
        }
    }

    public function listAll()
    {
        $services = $this->serviceModel->getAll();
        return $services;
    }
}
