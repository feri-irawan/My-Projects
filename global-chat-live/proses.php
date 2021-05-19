<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');

date_default_timezone_set("Asia/Makassar");


if (isset($_POST["chat"])) {
  $username = $_POST["username"];
  $chat = $_POST["chat"];

  if ($chat != null) {
    $db = json_decode(file_get_contents("chat.json"), true);

    $chat_array = [
      "username" => $username,
      "message" => htmlspecialchars($chat),
      "date" => date("d/m.Y"),
      "timestamp" => date("h:i")
    ];

    $db[] = $chat_array;

    file_put_contents("chat.json", json_encode($db, JSON_PRETTY_PRINT));
  }
}

if (isset($_POST["update"])) {
  $update = $_POST["update"];

  $db = json_decode(file_get_contents("chat.json"));

  if ($db != null) {
    foreach ($db as $chat) {

      $username = $chat->username;
      $message = nl2br($chat->message);
      $date = $chat->date;
      $timestamp = $chat->timestamp;

      echo '<div class="chat">
              <div class="chat-box">
                <div class="chat-header">
                  <div class="chat-username fw-bold">'.$username.'</div>
                  <div class="chat-time">
                    <span class="chat-date">'.$date.'</span>
                    <span class="chat-timestamp">'.$timestamp.'</span>
                  </div>
                </div>
                <div class="chat-body">'.$message.'</div>
              </div>
            </div>
            ';
    }
  }
}

// clear chat
if (isset($_GET["clear-chat"])) {
  file_put_contents("chat.json", "");
}
