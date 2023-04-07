<?php

 session_start();

// Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['message_counter']) || !is_numeric($_COOKIE['message_counter'])) {
    setcookie('message_counter', 0, time() + (86400 * 30), "/", ".nivelo.eu");
}


$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";

// $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dBName", $dBUsername, $dBPassword);
} catch(PDOException $e) {
    // Handle any database connection errors
    die("Database connection failed: " . $e->getMessage());
}


$name = $_SESSION["useruid"];
$input = html_entity_decode(htmlspecialchars($_POST['input'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
$chat_room_id = htmlspecialchars($_POST['chat_room_id'], ENT_QUOTES, 'UTF-8');
$chat_room_name = htmlspecialchars($_POST['chat_room_name'], ENT_QUOTES, 'UTF-8');
$chatToken = htmlspecialchars($_POST['chatToken'], ENT_QUOTES, 'UTF-8');

// Autoriser bruger
$authorized = false;
if (isset($_SESSION['useruid'])) {
    $session_user_id = $_SESSION['useruid'];
    $authorized = true;
}
if (!$authorized) {
    die("You are not authorized to view this page.");
}


// $sql = "INSERT INTO messages (inboxid, user_id, message) VALUES ('$chat_room_id', '$name', '$input')";

$stmt = $conn->prepare("INSERT INTO messages (inboxid, user_id, message) VALUES (:inboxid, :user_id, :message)");
$stmt->bindParam(':inboxid', $chat_room_id);
$stmt->bindParam(':user_id', $name);
$stmt->bindParam(':message', $input);

if ($stmt->execute()) {
    // Increment the counter by 1 and update the cookie
    $message_counter = intval($_COOKIE['message_counter']) + 1;
    setcookie('message_counter', $message_counter, time() + (86400 * 30), "/", ".nivelo.eu");

    header("location: ../room/$chatToken");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



?>