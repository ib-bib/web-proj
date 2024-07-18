<?php
/*
Done By Elteyp
*/
include_once(__DIR__ . "/controllers/ServiceController.php");
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
    <?php include('includes/header.inc.php'); ?>
    <div class="service-pricing">
        <?php foreach ($pricingInfo as $service) : ?>
            <h1 class="service-pricing-heading"><?php echo $service['name']; ?></h1>
            <div class="pricing-container">
                <?php foreach ($service['tiers'] as $tier) : ?>
                    <div class="pricing-card">
                        <div class="pricing-inner-card">
                            <h2><?php echo $tier['name']; ?> - $<?php echo $tier['price']; ?></h2>
                        </div>
                        <ul class="pricing-card-content">
                            <?php foreach ($tier['features'] as $feature) : ?>
                                <li><?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button onclick="toOrderPage('<?php echo $service['id']; ?>', '<?php echo $tier['id']; ?>')" class="pricing-order-btn">Order</button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include('includes/footer.inc.php'); ?>
    <script src="./assets/js/script.js"></script>
</body>

</html>