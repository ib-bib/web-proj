<?php

include_once(__DIR__ . "/controllers/MessageController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    
    $res = addMessage($_POST['subject'], $_POST['message'], $_POST['email']);

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
  <link rel="stylesheet" href="./assets/css/style.css"/>
  <style> 
    .cform {
      padding: 5px;
      width: 100%;
      height: 30em;
      display: flex;
      flex-direction: column;
      gap: 10px;
      justify-content: center;
      justify-items: center;
    }

    #inp-field {
      border: 3px solid black;
      padding: 4px;
    }

    #inp-field-txta {
      height: 40%;
      border: 3px solid black;
      padding: 4px;
      resize: none;
    }

    #inp-submit {
      width: 15%;
      border: 1px solid black;
      padding: 4px;
      align-self: center;
    }
  </style>
</head>

<body>
  <?php $current_page = 'contact'; include('includes/header.inc.php'); ?>
  <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
  <main class="contact-main">
    <p>Contact us by filling this form.</p>
    <form class="cform" target="dummyframe" action="./contact.php" method="POST" onsubmit="alert('Message sent!')">
      <input id="inp-field" type="email" name="email" placeholder="Email" required />
      <input id="inp-field" type="text" name="subject" placeholder="Subject" required />
      <textarea id="inp-field-txta" name="message" id="" placeholder="Message" required></textarea>
      <button id="inp-submit" type="submit">Send</button>
    </form>
  </main>
  <?php include('includes/footer.inc.php'); ?>
  <script src="./assets/js/script.js"></script>
  <script>

  </script>
</body>

</html>