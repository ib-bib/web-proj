<?php
class ServiceTierModel
{
    public $service_id;
    public $tier_id;
    public $price;

    public function __construct($service_id, $tier_id, $price)
    {
        $this->service_id = $service_id;
        $this->tier_id = $tier_id;
        $this->price = $price;
    }
}
