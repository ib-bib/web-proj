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
</body>

</html>