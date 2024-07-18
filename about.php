<!DOCTYPE html>
<!-- 
Author:  Elteyp
-->
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>About Us</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <style>
    .main {
      padding: 5%;
      width: 60%;
      font-family: 'roboto';
      font-size: 36px;
      font-weight: bold;
    }

    .btn {
      padding: 1%;
      font-size: 24px;
      text-decoration: none;
      color: black;
      border: 1px solid black;
    }
  </style>
</head>

<body>
  <?php $current_page = 'about';
  include('includes/header.inc.php'); ?>
  <div class="main">
    We are a team of three engineers dedicated to putting our efforts together and build high quality applications for the web and mobile devices.
    <br><br>
    Feel free to browse our services and contact-us if you need more information.
    <br><br>
    <a class="btn" href="/services.php">Services</a>
    <a class="btn" href="/contact.php">Contact Us</a>
  </div>
  <?php include('includes/footer.inc.php'); ?>
  <script src="./assets/js/script.js"></script>
</body>

</html>