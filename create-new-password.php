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
    <div class='modal-bodyi'>

    <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if (empty($selector) || empty($validator)) {
            echo "Kunne ikke validere din anmodning!";
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>

                <form class='form' action='/db/includes/reset-password.inc.php' method='POST' style='background-color: var(--b);border: none;width: 450px;'>
                    <input type='hidden' name='selector' value="<?php echo $selector ?>">
                    <input type='hidden' name='validator' value="<?php echo $validator ?>">
                    <input class='input3' autocomplete='off' type='password' required name='pwd-n' id='name' placeholder='Adgangskode' style='margin-bottom:5px'>
                    <input class='input3' autocomplete='off' type='password' required name='pwd-repeat-n' id='name' placeholder='Gentag adgangskode' style='margin-bottom:5px'>

                    <div class='modal-spc' style='text-align:center;'>
                        <button class='modal-btn startclr' type='submit' name='reset-password-submit'>Nulstil adgangskode</button>
                    </div>
                </form>

                <?php
            }
        }

    ?>


    </div>

<?php echo "</section>";



?>

<div id="preloader" class="loader"></div>




<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">