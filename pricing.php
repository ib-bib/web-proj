<?php
/*
Author:  Elteyb
Created: June 19
Modified: July 14
*/
include_once(__DIR__ . "/controllers/ServiceController.php");

// Instantiate ServiceController to retrieve pricing data
$serviceController = new ServiceController();
$pricingInfo = $serviceController->getPricingInfo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Pricing</title>
</head>

<body>
    <?php
    // Set current page for navigation highlighting
    $current_page = 'pricing';
    // Include header section
    include('includes/header.inc.php');
    ?>
    <div class="service-pricing">
        <?php foreach ($pricingInfo as $service) : ?>
            <!-- Service Pricing Heading -->
            <h1 class="service-pricing-heading"><?php echo $service['name']; ?></h1>
            <div class="pricing-container">
                <?php foreach ($service['tiers'] as $tier) : ?>
                    <div class="pricing-card">
                        <div class="pricing-inner-card">
                            <!-- Pricing Tier Name and Price -->
                            <h2><?php echo $tier['name']; ?> - $<?php echo $tier['price']; ?></h2>
                        </div>
                        <ul class="pricing-card-content">
                            <?php foreach ($tier['features'] as $feature) : ?>
                                <!-- List of Features for each Pricing Tier -->
                                <li><?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <!-- Order Button with onclick function -->
                        <button onclick="toOrderPage('<?php echo $service['id']; ?>', '<?php echo $tier['id']; ?>')" class="pricing-order-btn">Order</button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    // Include footer section
    include('includes/footer.inc.php');
    ?>
    <!-- JavaScript file for additional functionality -->
    <script src="./assets/js/script.js"></script>
</body>

</html>