<?php

session_start();

$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_SESSION["useruid"];
$color = mysqli_real_escape_string($conn, $_POST['color']);
$emailchange = mysqli_real_escape_string($conn, $_POST['mailchange']);
$namechange = mysqli_real_escape_string($conn, $_POST['namechange']);


// Autoriser bruger
$authorized = false;
if (isset($_SESSION['useruid'])) {
    $session_user_id = $_SESSION['useruid'];
    $authorized = true;
}
if (!$authorized) {
    die("You are not authorized to view this page.");
}



$messagePROFILE = '';

if (!empty($color)) {
    $sql = "UPDATE users SET usersColor = ? WHERE usersUid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $color, $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $messagePROFILE = "Opdateret!";
}

if (!empty($emailchange)) {
    $sql = "UPDATE users SET usersEmail = ? WHERE usersUid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $emailchange, $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $messagePROFILE = "Opdateret!";
}

if (!empty($namechange)) {
    $sql = "UPDATE users SET usersName = ? WHERE usersUid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $namechange, $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $messagePROFILE = "Opdateret!";
}

if (empty($color) && empty($emailchange) && empty($namechange)) {
    $messagePROFILE = "Indtast en værdi!";
}

if ($messagePROFILE == '') {
    $messagePROFILE = "Fejl!";
}

header("location: ../../profile?message=" . urlencode($messagePROFILE));


?>