<?php
/*
Done By Talal
*/
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
        <section class="service-section" data-service-id="<?php echo $service['id']; ?>">
            <div class="service-top">
                <h2 class="service-title"><?php echo $service['name']; ?></h2>
                <div class="service-tiers">
                    <?php foreach ($service['tiers'] as $tier) : ?>
                        <span onclick="toOrderPage('<?php echo $service['id']; ?>', '<?php echo $tier['id']; ?>')" class="tier">
                            <?php echo $tier['name']; ?>
                        </span>
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
                                <img src=".<?php echo $image['url']; ?>" alt="<?php echo $image['name']; ?>">
                            </div>
                        <?php endforeach; ?>
                        <a class="prev" onclick="plusSlides(-1, <?php echo $service['id']; ?>)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1, <?php echo $service['id']; ?>)">&#10095;</a>
                    </div>
                    <br />
                    <div class="dot-container">
                        <?php for ($i = 1; $i <= $imageCount; $i++) : ?>
                            <span class="dot" onclick="currentSlide(<?php echo $i; ?>, <?php echo $service['id']; ?>)"></span>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

    <footer>
        <div class="footer-sections">
            <div>
                <h4 class="footer-section-subtitle">The Team</h4>
                <div class="footer-section-list">
                    <a href="https://github.com/talalio">Talal Nasraddeen</a>
                    <a href="https://github.com/elteyp">Elteyp Mohammed</a>
                    <a href="https://github.com/ib-bib">Ibrahim Adil</a>
                </div>
            </div>
            <div>
                <h4 class="footer-section-subtitle">Connect With Us</h4>
                <div class="footer-section-list">
                    <a href="https://github.com">GitHub</a>
                    <a href="https://linkedin.com">LinkedIn</a>
                    <a href="https://youtube.com">YouTube</a>
                    <a href="https://x.com">X (Twitter)</a>
                </div>
            </div>
            <div>
                <h4 class="footer-section-subtitle">Trusted Partners</h4>
                <div class="footer-section-list">
                    <a href="https://apachefriends.org">Apache Friends</a>
                    <a href="https://php.net">Hypertext Preprocessor</a>
                    <a href="https://mysql.com">MySQL</a>
                    <a href="https://ecma-international.org">ECMA International</a>
                    <a href="https://w3c.org">W3C</a>
                    <a href="https://paypal.com">PayPal</a>
                </div>
            </div>
        </div>
        <div class="footer-rights">All Rights Reserved &copy; 2024 TEI Technolgy LLC.</div>
    </footer>
    <script>
        let slideIndexes = {};

        function initSlides(serviceId) {
            slideIndexes[serviceId] = 1;
            showSlides(1, serviceId);
        }

        function plusSlides(n, serviceId) {
            showSlides(slideIndexes[serviceId] += n, serviceId);
        }

        function currentSlide(n, serviceId) {
            showSlides(slideIndexes[serviceId] = n, serviceId);
        }

        function showSlides(n, serviceId) {
            let i;
            let slides = document.querySelectorAll(`.service-section[data-service-id="${serviceId}"] .mySlides`);
            let dots = document.querySelectorAll(`.service-section[data-service-id="${serviceId}"] .dot`);

            if (n > slides.length) {
                slideIndexes[serviceId] = 1;
            }
            if (n < 1) {
                slideIndexes[serviceId] = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none"; /* Hide all slides */
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", ""); /* Deactivate all dots */
            }
            slides[slideIndexes[serviceId] - 1].style.display = "flex"; /* Show current slide */
            dots[slideIndexes[serviceId] - 1].className += " active"; /* Activate current dot */
        }

        // Initialize slides for each service
        document.querySelectorAll('.service-section').forEach(section => {
            const serviceId = section.getAttribute('data-service-id');
            initSlides(serviceId);
        });
    </script>
    <script src="./assets/js/script.js"></script>
</body>

</html>