<?php
    session_start();
  
    // Check if the token cookie has expired
    if (!isset($_COOKIE["login_token"]) && time() < $_COOKIE["login_token"]) {
        // Destroy the session and unset the token cookie

        session_regenerate_id(true);
        
        session_start();
        session_unset();
        session_destroy();
        
        setcookie("user", "", time() - 3600, "/");
        setcookie("login_token", "", time() - 3600, "/");

        // Redirect the user to the login page
        header("Location: ../../login.php");
        exit;
    }

    $_SESSION['user_id'] = $uid; // assuming $user_id is the ID of the logged in user

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pageload.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/theme-popup.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/media.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="title" content="Webportal">
    <meta name="description" content="Webportal mellem selvstændige og klienter">
    <meta name="keywords" content="">

    <meta name="author" content="Magnus Hvidtfeldt"> 
    <meta name="start_url" content="https://">
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/scripts/dynamic-page-loading-nav.js"></script>

    <meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Nivelo">
	<meta name="twitter:description" content="Webportal mellem selvstændige og klienter">
	<meta name="twitter:image" content="https://"> 
    <meta name="twitter:site" content="@hvidtfldt">

	<meta property="og:locale" content="en_US">
	<meta property="og:title" content="Nivelo">
	<meta property="og:description" content="Webportal mellem selvstændige og klienter">
	<meta property="og:url" content="https://">
	<meta property="og:image" content="https://">
	<meta property="og:type" content="website">

    <link rel="icon" type="image/x-icon" href="/assets/ico.png">