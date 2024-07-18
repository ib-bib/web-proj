<?php

include_once(__DIR__ . "/config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $dbc = getDBConnection();
  if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $cemail = $dbc->real_escape_string($_POST['email']);
    $csubject = $dbc->real_escape_string($_POST['subject']);
    $cmessage = $dbc->real_escape_string($_POST['message']);

    // insert data to database
    $sql = "INSERT INTO messages (email, subject, message) VALUES ('" . $cemail . "', '" . $csubject . "', '" . $cmessage . "')";
    $res = $dbc->query($sql);

    header("Content-Type: application/json");

    if ($res) {
      echo json_encode(array("status" => True, "message" => "Message sent successfully!"));
      return;
    }

    echo json_encode(array("status" => False, "message" => "Failed to send your message!"));
    return;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ContactUS</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <nav id="navbar">
    <div>
      <span class="not-current-span"><a class="not-current-link" href="./home.html">Home</a></span>
      <span class="not-current-span">|</span>
      <span class="not-current-span"><a class="not-current-link" href="./about.html">About Us</a></span>
      <span class="not-current-span"><a class="not-current-link" href="./services.php">Services</a></span>
      <span class="not-current-span"><a class="not-current-link" href="./pricing.php">Pricing</a></span>
      <span class="not-current-span"><a class="not-current-link" href="./order.php">Order</a></span>
      <span id="current-span"><a id="current-link">Contact Us</a></span>
    </div>
  </nav>
  <main class="contact-main">
    <p>Contact us by filling this form.</p>
    <form class="cform" action="./contact.php" method="POST">
      <input id="inp-field" type="email" name="email" placeholder="Email" required />
      <input id="inp-field" type="text" name="subject" placeholder="Subject" required />
      <textarea id="inp-field-txta" name="message" id="" placeholder="Message" required></textarea>
      <button id="inp-submit" type="submit">Send</button>
    </form>
  </main>
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
  <script src="./assets/js/script.js"></script>
</body>

</html>