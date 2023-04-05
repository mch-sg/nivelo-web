<?php

session_start();

$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";


$name = $_SESSION["useruid"];
$input = $_POST['input'];

// $chat_room_id = $_POST['chat_room_id'];
$chat_room_name = $_POST['room_name'];
$bruger = $_POST['bruger'];
$from = $_SESSION['useruid'];
$chat_id = uniqid();


// Autoriser bruger
$authorized = false;
if (isset($_SESSION['useruid'])) {
    $session_user_id = $_SESSION['useruid'];
    if ($session_user_id == $user_from_id || $session_user_id == $user_to_id) {
        $authorized = true;
    }
}
if (!$authorized) {
    die("You are not authorized to view this page.");
}


$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);


// Insert the new room into the database
$sql = "INSERT INTO chat_rooms (name, user_from, user_to, uuid) VALUES ('$chat_room_name', '$from', '$bruger', '$chat_id');";

// $sql = "UPDATE 'messages' SET 'message' = '$input' WHERE 'messages'.'id' = 1;";

if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";
    header("location: chat_room.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>