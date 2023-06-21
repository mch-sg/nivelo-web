<?php

// // Forbinder til databasen
// $serverName = "127.0.0.1:3306";
// $dBUsername = "u463909974_exam";
// $dBPassword = "Ekg123321";
// $dBName = "u463909974_portal";

// $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

// // Hvis forbindelsen ikke oprettes, visen fejlbesked
// if (!$conn) {
//     die("Connection failed: ".mysqli_connect_error());
// }

// Skaber forbindelse til databasen
$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dBName", $dBUsername, $dBPassword);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
