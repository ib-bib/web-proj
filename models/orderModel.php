<?php
class OrderModel
{
    public $customer_email;
    public $service_tier;
    public $reference_id;

    public function __construct($customer_email, $service_tier, $reference_id)
    {
        $this->customer_email = $customer_email;
        $this->service_tier = $service_tier;
        $this->reference_id = $reference_id;
    }
}
