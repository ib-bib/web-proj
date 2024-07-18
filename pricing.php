<?php
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
    <nav id="navbar">
        <div>
            <span class="not-current-span"><a class="not-current-link" href="./home.html">Home</a></span>
            <span class="not-current-span">|</span>
            <span class="not-current-span"><a class="not-current-link" href="./about.html">About</a></span>
            <span class="not-current-span"><a class="not-current-link" href="./services.php">Services</a></span>
            <span id="current-span"><a id="current-link">Pricing</a></span>
            <span class="not-current-span"><a class="not-current-link" href="./order.php">Order</a></span>
            <span class="not-current-span"><a class="not-current-link" href="./contact.php">Contact Us</a></span>
        </div>
    </nav>
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
    <footer>
        <div class="footer-sections">
            <div>
                <h4 class="footer-section-subtitle">Services</h4>
                <div class="footer-section-list">
                    <p>UI/UX Design</p>
                    <p>Front-end</p>
                    <p>Mobile Apps</p>
                    <p>Back-end</p>
                    <p>Full-stack</p>
                </div>
            </div>
            <div>
                <h4 class="footer-section-subtitle">The Team</h4>
                <div class="footer-section-list">
                    <p>Talal Nasrldeen</p>
                    <p>Elteyp Mohammed</p>
                    <p>Ibrahim Adil</p>
                </div>
            </div>
            <div>
                <h4 class="footer-section-subtitle">Connect With Us</h4>
                <div class="footer-section-list">
                    <p>GitHub</p>
                    <p>LinkedIn</p>
                    <p>YouTube</p>
                    <p>X (Twitter)</p>
                </div>
            </div>
            <div>
                <h4 class="footer-section-subtitle">Trusted Partners</h4>
                <div class="footer-section-list">
                    <p>Apache Friends</p>
                    <p>Hypertext Preprocessor</p>
                    <p>MySQL</p>
                    <p>ECMA International</p>
                    <p>W3C</p>
                    <p>PayPal</p>
                </div>
            </div>
        </div>
        <div class="footer-rights">All Rights Reserved &copy; 2024 TEI Technolgy LLC.</div>
    </footer>
    <script src="./assets/js/script.js"></script>
</body>

</html>