<?php

session_start();

 // Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['invite_counter'])) {
    setcookie('invite_counter', 0, time() + (86400 * 30), "/", ".nivelo.eu"); // 30 days
}

// Increment the counter by 1 and update the cookie
$invite_counter = $_COOKIE['invite_counter'] + 1;
setcookie('invite_counter', $invite_counter, time() + (86400 * 30), "/", ".nivelo.eu"); // 30 days

include_once '../includes/dbh.inc.php';


$name = $_SESSION["useruid"];
$input = htmlspecialchars($_POST['input'], ENT_QUOTES, 'UTF-8');

$chat_room_name = html_entity_decode(htmlspecialchars($_POST['room_name'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
$bruger = htmlspecialchars($_POST['bruger'], ENT_QUOTES, 'UTF-8');
$from = $_SESSION['useruid'];
$chat_id = uniqid();


// Autoriser bruger
$authorized = false;
if (isset($_SESSION['useruid'])) {
    $session_user_id = $_SESSION['useruid'];
    $authorized = true;
}
if (!$authorized) {
    die("You are not authorized to view this page.");
}


// Insert the new room into the database
// $sql = "INSERT INTO chat_rooms (name, user_from, user_to, uuid) VALUES ('$chat_room_name', '$from', '$bruger', '$chat_id');";

$stmt = $conn->prepare("INSERT INTO chat_rooms (name, user_from, user_to, uuid) VALUES (:name, :user_from, :user_to, :uuid)");
$stmt->bindParam(':name', $chat_room_name);
$stmt->bindParam(':user_from', $from);
$stmt->bindParam(':user_to', $bruger);
$stmt->bindParam(':uuid', $chat_id);


if ($stmt->execute()) {
    // echo "New record created successfully";
    header("location: https://chat.nivelo.eu");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>