<?php
 session_start();
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
        <input class='input3' autocomplete='off' type='email' required name='email2' id='name' placeholder='Emailaddresse' style='margin-bottom:20px'>

            <div class='' style='text-align:center;'>
                <button class='modal-btn startclr' type='submit' name='reset-request-submit' style="width:100%">Send ny kode til min email</button>
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

 