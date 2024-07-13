<?php
include_once(__DIR__ . "/../models/ServiceModels.php");
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

    public function getPricingInfo()
    {
        $services = $this->serviceModel->getAllServices();
        $data = [];

        while ($service = $services->fetch_assoc()) {
            $serviceId = $service['id'];
            $tiers = $this->serviceModel->getTiersByServiceId($serviceId);

            $serviceData = [
                'name' => $service['name'],
                'tiers' => []
            ];

            while ($tier = $tiers->fetch_assoc()) {
                $serviceTierId = $tier['id'];
                $features = $this->serviceModel->getFeaturesByServiceTierId($serviceTierId);

                $tierData = [
                    'name' => $tier['name'],
                    'price' => $tier['price'],
                    'features' => []
                ];

                while ($feature = $features->fetch_assoc()) {
                    $tierData['features'][] = $feature['description'];
                }

                $serviceData['tiers'][] = $tierData;
            }

            $data[] = $serviceData;
        }

        return $data;
    }

    public function listAll()
    {
        $services = $this->serviceModel->getAll();
        return $services;
    }
}
