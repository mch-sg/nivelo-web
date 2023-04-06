<?php
session_start();
?>

<?php
    include_once 'db/includes/header.php';
?>
<title>Log på - Nivelo</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';
?>


<section class="logScale">
    <div style="padding: 25px;font-size: 1.5rem;">
        <div class="title sysText" style="text-align: center;">Log på</div>
    </div>
    <div class="modal-bodyi">
        <form class="form" action="db/includes/login.inc.php" method="post" style="background-color: var(--b);border: none;width: 450px;">
        <!-- <label class="label" for="uid" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Brugernavn/email</label> -->
        <input class="input3" type="text" name="uid" placeholder="Brugernavn / Email" style="margin-bottom:20px">

        <!-- <label class="label" for="pwd" style="color: #e7e7e7;font-size: 16px;font-weight: 200;">Adgangskode</label> -->
            <input class="input3"  type="password" name="pwd" placeholder="Adgangskode" style="margin-bottom:20px">

            <div class="" style="text-align:center;">
                <button class="modal-btn startclr" type="submit" name="submit" style="width: 100%;margin-bottom: 30px;">Log på</button>
            </div>
        </form>
        
        <div style="text-align:center;font-size: 18px;font-weight: 300;color:white;opacity:0.25"><a class="hv" href="/reset-password">Glemt adgangskode?</a></div>

    </div>

    <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<p style='margin-top:35px;text-align:center'>Udfyld alle felter!</p>";
            }
            else if($_GET["error"] == "wronglogin") {
                echo "<p style='margin-top:35px;text-align:center'>Forkert login!</p>";
            }
        }

        if(isset($_GET["newpwd"])) {
            if($_GET["newpwd"] == "passwordupdated") {
                echo "<p style='margin-top:35px;text-align:center'>Din adgangskode er blevet ændret!</p>";
            }
        }
    ?>

</section>

<div id="preloader" class="loader"></div>



<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="/css/palette-selector.css">