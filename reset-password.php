<?php
session_start();

// Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['reset_c'])) {
    setcookie('reset_c', 0, time() + (86400 * 30)); // 30 days
}

// Increment the counter by 1 and update the cookie
$reset_c = $_COOKIE['reset_c'] + 1;
setcookie('reset_c', $reset_c, time() + (86400 * 30)); // 30 days

?>

<?php
    include_once 'db/includes/header.php';
?>
<title>Reset - Nivelo</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';
?>

<section class='logScale'> <!-- style='margin-top: 75px;' -->
    <div style='padding: 25px;font-size: 1.5rem;'>
        <div class='title sysText' style='text-align: center;'>Lav en ny adgangskode</div>
    </div>
    <div class='modal-bodyi'>
        <form class='form' action='/db/includes/reset-request.inc.php' method='POST' style='background-color: var(--b);border: none;width: 450px;'>
        <input class='input3' autocomplete='off' type='email' required name='email2' id='name' placeholder='Emailaddresse' style='margin-bottom:5px'>

            <div class='modal-spc' style='text-align:center;'>
                <button class='modal-btn startclr' type='submit' name='reset-request-submit'>Lav chat</button>
            </div>
        </form>
    </div>";

    <?php

        if(isset($_GET["reset"])) {
            if($_GET["reset"] == "success") {
                echo "<p style='margin-top:5px;text-align:center'>Tjek din email!</p>";
            }
        }
    ?>

<?php echo "</section>";



?>

<div id="preloader" class="loader"></div>




<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">