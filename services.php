<?php
include_once(__DIR__ . "/controllers/ServiceController.php");

// Create an instance of the ServiceController
$controller = new ServiceController();
$servicesInfo = $controller->getServicesInfo();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Services</title>
</head>

<body>
    <nav id="navbar">
        <div>
            <span class="not-current-span"><a class="not-current-link" href="./home.html">Home</a></span>
            <span class="not-current-span">|</span>
            <span class="not-current-span"><a class="not-current-link" href="./about.html">About</a></span>
            <span id="current-span"><a id="current-link">Services</a></span>
            <span class="not-current-span"><a class="not-current-link" href="./pricing.php">Pricing</a></span>
            <span class="not-current-span"><a class="not-current-link" href="./order.php">Order</a></span>
            <span class="not-current-span"><a class="not-current-link" href="./contact.php">Contact Us</a></span>
        </div>
    </nav>
    <?php foreach ($servicesInfo as $service) : ?>
        <section class="service-section">
            <div class="service-top">
                <h2 class="service-title"><?php echo $service['name']; ?></h2>
                <div class="service-tiers">
                    <?php foreach ($service['tiers'] as $tier) : ?>
                        <span class="tier"><?php echo $tier; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="service-bottom">
                <div class="service-description">
                    <?php echo $service['description']; ?>
                </div>
                <div class="service-slideshow">
                    <div class="slideshow-container">
                        <?php $imageCount = count($service['images']); ?>
                        <?php foreach ($service['images'] as $index => $image) : ?>
                            <div class="mySlides fade">
                                <div class="numbertext"><?php echo $index + 1; ?> / <?php echo $imageCount; ?></div>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['name']; ?>">
                            </div>
                        <?php endforeach; ?>
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                    <br />
                    <div class="dot-container">
                        <?php for ($i = 1; $i <= $imageCount; $i++) : ?>
                            <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
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