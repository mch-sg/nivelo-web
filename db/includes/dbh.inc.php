<?php

// // Forbinder til databasen
// $serverName = "--REDACTED--";
// $dBUsername = "--REDACTED--";
// $dBPassword = "--REDACTED--";
// $dBName = "--REDACTED--";

// $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

// // Hvis forbindelsen ikke oprettes, visen fejlbesked
// if (!$conn) {
//     die("Connection failed: ".mysqli_connect_error());
// }

// Skaber forbindelse til databasen
$serverName = "--REDACTED--";
$dBUsername = "--REDACTED--";
$dBPassword = "--REDACTED--";
$dBName = "--REDACTED--";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dBName", $dBUsername, $dBPassword);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
