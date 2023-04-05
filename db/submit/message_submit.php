<?php

session_start();

// Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['_bsked_s_cc_']) || !is_numeric($_COOKIE['_bsked_s_cc'])) {
    setcookie('_bsked_s_cc', 0, time() + (86400 * 30), '/', $_SERVER['HTTP_HOST']);
}


$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";


$name = $_SESSION["useruid"];
$input = $_POST['input'];
$chat_room_id = $_POST['chat_room_id'];
$chat_room_name = $_POST['chat_room_name'];
$chatToken = $_POST['chatToken'];

// Autoriser bruger
$authorized = false;
if (isset($_SESSION['useruid'])) {
    $session_user_id = $_SESSION['useruid'];
    $authorized = true;
}
if (!$authorized) {
    die("You are not authorized to view this page.");
}


$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);


$sql = "INSERT INTO messages (inboxid, user_id, message) VALUES ('$chat_room_id', '$name', '$input')";


if (mysqli_query($conn, $sql)) {
    // Increment the counter by 1 and update the cookie
    $_bsked_s_cc = intval($_COOKIE['_bsked_s_cc']) + 1;
    setcookie('_bsked_s_cc', $_bsked_s_cc, time() + (86400 * 30), '/', $_SERVER['HTTP_HOST']);



    header("location: ../../chat_room_s.php?room=$chatToken");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>