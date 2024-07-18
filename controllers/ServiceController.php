<?php
include_once(__DIR__ . "/../models/ServiceModels.php");
class ServiceController
{
    private $serviceModel;
    private $tierModel;
    private $imageModel;
    private $featureModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->tierModel = new TierModel();
        $this->imageModel = new ServiceImageModel();
        $this->featureModel = new ServiceTierFeatureModel();
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
            $tiers = $this->tierModel->getTiersByServiceId($serviceId);

            $serviceData = [
                'id' => $service['id'],
                'name' => $service['name'],
                'tiers' => []
            ];

            while ($tier = $tiers->fetch_assoc()) {
                $serviceTierId = $tier['id'];
                $features = $this->featureModel->getFeaturesByServiceTierId($serviceTierId);

                $tierData = [
                    'id' => $tier['id'],
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

    public function getServicesInfo()
    {
        $services = $this->serviceModel->getAllServices();
        $data = [];

        while ($service = $services->fetch_assoc()) {
            $serviceId = $service['id'];
            $tiers = $this->tierModel->getTiersByServiceId($serviceId);
            $images = $this->imageModel->getImagesByServiceId($serviceId);

            $serviceData = [
                'id' => $service['id'],
                'name' => $service['name'],
                'description' => $service['description'],
                'tiers' => [],
                'images' => []
            ];

            while ($tier = $tiers->fetch_assoc()) {
                $serviceData['tiers'][] = [
                    'id' => $tier['id'],
                    'name' => $tier['name']
                ];
            }

            while ($image = $images->fetch_assoc()) {
                $serviceData['images'][] = [
                    'url' => $image['image_url'],
                    'name' => $image['image_name']
                ];
            }

            $data[] = $serviceData;
        }

        return $data;
    }
}
