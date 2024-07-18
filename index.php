<!DOCTYPE html>
<!-- 
Done By Elteyp
-->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>TEI Web Services</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .home-main {
            width: 80%;
        }

        .intro {
            padding: 5%;
            width: 60%;
            font-family: 'roboto';
            font-size: 36px;
            font-weight: bold;
            /* color: white; */
            /* background-color: rgba(75, 75, 100, 0.5); */
            /* backdrop-filter: blur(20px); */
        }

        .btn-services {
            padding: 1%;
            font-size: 24px;
            text-decoration: none;
            color: black;
            border: 1px solid black;
        }

    </style>
  </head>
  <body>
    <?php include('includes/header.inc.php'); ?>
    <main class="home-main">
        <div class="intro">
            We are a team of software developers who like to build and design
            web and mobile applications. We developed web applications for popular
            brands like X, Y, and Z.
            <br><br>
            <a class="btn-services" href="/services.php">Services</a>
        </div>
    </main>
    <?php include('includes/footer.inc.php'); ?>
    <script src="./assets/js/script.js"></script>
  </body>
</html>
