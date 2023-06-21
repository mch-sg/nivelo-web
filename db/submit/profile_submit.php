<?php

session_start();

include_once '../includes/dbh.inc.php';

$name = $_SESSION["useruid"];
$color = $_POST['color'];
$theme = $_POST['theme'];
$emailchange = $_POST['mailchange'];
$namechange = $_POST['namechange'];
$teamchange = $_POST['teamchange'];
$uidchange = $_POST['uidchange'];


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

// if(!empty($uidchange)) {
    
//     $sql = "UPDATE users
//     SET usersUid = ?
//     WHERE usersUid = ?";

//     mysqli_stmt_bind_param($stmt, "ss", $uidchange, $name);
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     $sql = "UPDATE messages 
//     SET user_id = ?
//     WHERE user_id = ?";

//     mysqli_stmt_bind_param($stmt, "ss", $uidchange, $name);
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     $sql = "UPDATE chat_rooms
//     SET user_to = ? 
//     WHERE user_to = ?";

//     mysqli_stmt_bind_param($stmt, "ss", $uidchange, $name);
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     $sql = "UPDATE chat_rooms
//     SET user_from = ? 
//     WHERE user_from = ?";

//     mysqli_stmt_bind_param($stmt, "ss", $uidchange, $name);
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     $messagePROFILE = "Opdateret id!";

// }

if (!empty($color)) {
    if(strpos($color, '#') !== 0) {
        $color = "#" . $color;
    }

    $stmt = $conn->prepare("UPDATE users SET usersColor = :uc WHERE usersUid = :ui"); 
    $stmt->bindParam(':uc', $color);
    $stmt->bindParam(':ui', $name);
    $stmt->execute();
    $messagePROFILE = "Opdateret!";
}

if (!empty($theme)) {
    if(strpos($theme, '#') !== 0) {
        $theme = "#" . $theme;
    }

    $stmt = $conn->prepare("UPDATE users SET usersTheme = :uc WHERE usersUid = :ui"); 
    $stmt->bindParam(':uc', $theme);
    $stmt->bindParam(':ui', $name);
    $stmt->execute();
    $messagePROFILE = "Opdateret!";
}

if (!empty($teamchange)) {
    if($teamchange === " ") {
        $stmt = $conn->prepare("UPDATE users SET company = NULL WHERE usersUid = :ui"); 
        $stmt->bindParam(':ui', $name);
        $stmt->execute();
        $messagePROFILE = "Fjernet!";
    
    } else {

    $stmt = $conn->prepare("UPDATE users SET company = :uc WHERE usersUid = :ui"); 
    $stmt->bindParam(':uc', $teamchange);
    $stmt->bindParam(':ui', $name);
    $stmt->execute();
    $messagePROFILE = "Opdateret!";
    
    }
}

if (!empty($emailchange)) {
    $stmt = $conn->prepare("UPDATE users SET usersEmail = :uc WHERE usersUid = :ui"); 
    $stmt->bindParam(':uc', $emailchange);
    $stmt->bindParam(':ui', $name);
    $stmt->execute();
    $messagePROFILE = "Opdateret!";
}

if (!empty($namechange)) {
    $stmt = $conn->prepare("UPDATE users SET usersName = :uc WHERE usersUid = :ui"); 
    $stmt->bindParam(':uc', $namechange);
    $stmt->bindParam(':ui', $name);
    $stmt->execute();
    $messagePROFILE = "Opdateret!";
}


if (empty($color) && empty($theme) && empty($emailchange) && empty($namechange) && empty($teamchange) && empty($uidchange)) {
    $messagePROFILE = "Indtast en værdi!";
}

if ($messagePROFILE == '') {
    $messagePROFILE = "Fejl!";
}

header("location: ../../profile?message=" . urlencode($messagePROFILE));


?>