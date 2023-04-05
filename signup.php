<?php
session_start();
    include_once 'db/includes/header.php';
?>
<title>Tilmeld - Nivelo</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';
?>


<section class='logScale'> <!-- style='margin-top: 75px;' -->
    <div style="padding: 25px;font-size: 1.5rem;">
        <div class="title sysText" style="text-align: center;">Tilmeld</div>
    </div>
    <div class="modal-bodyi">
        <form class="form" action="db/includes/signup.inc.php" method="post" style="background-color: var(--b);border: none;width: 450px;">
            <!-- <label class="label" for="name" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Fulde navn</label> -->
            <input class="input3" type="text" name="name" placeholder="Fulde Navn" style="margin-bottom:20px;">

            <!-- <label class="label" for="email" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Email</label> -->
            <input class="input3"  type="text" name="email" placeholder="Email" style="margin-bottom:20px;">

            <!-- <label class="label" for="uid" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Brugernavn</label> -->
            <input class="input3"  type="text" name="uid" placeholder="Brugernavn" style="margin-bottom:20px;">

            <!-- <label class="label" for="pwd" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Adgangskode</label> -->
            <input class="input3"  type="password" name="pwd" placeholder="Adgangskode" style="margin-bottom:20px;">

            <!-- <label class="label" for="pwdrepeat" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Gentag adgangskode</label> -->
            <!-- <input class="input3"  type="password" name="pwdrepeat" placeholder="" style="margin-top:10px;margin-bottom:5px;"> -->
            
            <!-- <small class="" style="font-weight: 300">Glemt adgangskode?</small> -->

            <div class="modal-spc" style="text-align:center;">
                <button class="modal-btn startclr" type="submit" name="submit">Lav din nye konto</button>
            </div>
            <!-- <p style='margin-top:50px;text-align:center;font-weight:300;font-size:17px;'>Har du allerede en konto? <a href="/login.php"> Log på</a></p> -->
        </form>


    </div>

    <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<p style='margin-top:5px;text-align:center'>Udfyld alle felter!</p>";
            }
            else if($_GET["error"] == "invaliduid") {
                echo "<p style='margin-top:5px;text-align:center'>Dette brugernavn er ikke tilgængeligt!</p>";
            }
            else if($_GET["error"] == "invalidemail") {
                echo "<p style='margin-top:5px;text-align:center'>Denne email er ikke tilgængelig!</p>";
            }
            else if($_GET["error"] == "passwordsdontmatch") {
                echo "<p style='margin-top:5px;text-align:center'>Adgangskoderne er ikke det samme!</p>";
            }
            else if($_GET["error"] == "stmtfailed") {
                echo "<p style='margin-top:5px;text-align:center'>Noget gik galt, prøv igen!</p>";
            }
            else if($_GET["error"] == "usernametaken") {
                echo "<p style='margin-top:5px;text-align:center'>Brugernavnet er allerede i brug!</p>";
            }
            else if($_GET["error"] == "none") {
                echo "<p style='margin-top:5px;text-align:center'>Du har nu tilmeldt dig!</p>";
            }
        }
    ?>

</section>



<div id="preloader" class="loader"></div>
<!-- <footer class="footer" style="position:fixed;">

<p class="copy">© Webportal by <a href="https://" target="_blank"> Magnus Hvidtfeldt</a></p>

</footer> -->



<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">