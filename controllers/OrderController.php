<?php
/*
Author: Ibrahim
Created: July 14
Modified: July 18
*/

// Include the OrderModel for database interactions
include_once(__DIR__ . "/../models/OrderModel.php");

// OrderController class to handle order-related operations
class OrderController
{
    private $orderModel;

    // Constructor to initialize OrderModel instance
    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    // Method to get available services and their tiers
    public function getServicesAndTiers()
    {
        return $this->orderModel->getServicesAndTiers();
    }

    // Private method to generate a unique reference ID for orders
    private function generateReferenceId()
    {
        $prefix = 'A';
        $part1 = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $part2 = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $part3 = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        return "$prefix-$part1-$part2-$part3";
    }

    // Method to create a new order
    public function createOrder($serviceTierId, $clientEmail)
    {
        $ref_id = $this->generateReferenceId();
        return $this->orderModel->createOrder($serviceTierId, $clientEmail, $ref_id);
    }

    // Method to track an existing order by reference ID
    public function trackOrder($referenceId)
    {
        return $this->orderModel->trackOrder($referenceId);
    }

    // Method to cancel an existing order by order ID
    public function cancelOrder($orderID)
    {
        return $this->orderModel->cancelOrder($orderID);
    }
}
