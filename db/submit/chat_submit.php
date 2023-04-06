<?php

session_start();

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
$input = htmlspecialchars($_POST['input'], ENT_QUOTES, 'UTF-8');

$chat_room_name = htmlspecialchars($_POST['room_name'], ENT_QUOTES, 'UTF-8');
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
    header("location: ../../chat_room_s");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>