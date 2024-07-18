<?php
include_once(__DIR__ . "/../models/OrderModel.php");

class OrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function getServicesAndTiers()
    {
        return $this->orderModel->getServicesAndTiers();
    }

    private function generateReferenceId()
    {
        $prefix = 'A';
        $part1 = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $part2 = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $part3 = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        return "$prefix-$part1-$part2-$part3";
    }

    public function createOrder($serviceTierId, $clientEmail)
    {
        $ref_id = $this->generateReferenceId();
        return $this->orderModel->createOrder($serviceTierId, $clientEmail, $ref_id);
    }

    public function trackOrder($referenceId)
    {
        return $this->orderModel->trackOrder($referenceId);
    }

    public function cancelOrder($orderID)
    {
        return $this->orderModel->cancelOrder($orderID);
    }
}
