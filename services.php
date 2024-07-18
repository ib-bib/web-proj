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
    <link rel="stylesheet" href="./assets/css/services.css">
    <title>Services</title>
</head>

<body>
    <?php $current_page = 'services'; include('includes/header.inc.php'); ?>
    <?php foreach ($servicesInfo as $service) : ?>
        <section class="service-section" data-service-id="<?php echo $service['id']; ?>">
            <div class="service-container">
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
            </div>
        </section>
    <?php endforeach; ?>
    <?php include('includes/footer.inc.php'); ?>
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