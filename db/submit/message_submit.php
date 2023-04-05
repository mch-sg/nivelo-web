<?php

session_start();

$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";


$name = $_SESSION["useruid"];
$input = $_POST['input'];
$chat_room_id = $_POST['chat_room_id'];
$chat_room_name = $_POST['chat_room_name'];

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


$sql = "INSERT INTO messages (inboxid, user_id, message) VALUES ('$chat_room_id', '$name', '$input')";


// Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['_bskc'])) {
    setcookie('_bskc', 0, time() + (86400 * 30)); // 30 days
}

// Increment the counter by 1 and update the cookie
$_bskc = $_COOKIE['_bskc'] + 1;
setcookie('_bskc', $_bskc, time() + (86400 * 30)); // 30 days



if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";
    header("location: chat_room.php?room=$chat_room_id");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>