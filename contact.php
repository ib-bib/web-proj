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
  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
  <!-- Nav (should collapse to sidebar in mobile view) -->
  <main class="main">
    <p>Contact us by filling this form.</p>
    <form class="cform" action="./contact.php" method="POST">
      <input id="inp-field" type="email" name="email" placeholder="Email" required />
      <input id="inp-field" type="text" name="subject" placeholder="Subject" required />
      <textarea id="inp-field-txta" name="message" id="" placeholder="Message" required></textarea>
      <button id="inp-submit" type="submit">Send</button>
    </form>
  </main>
  <!-- Footer -->
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