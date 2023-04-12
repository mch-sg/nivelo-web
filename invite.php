<?php
session_start();
?>

<?php
    include_once 'db/includes/header.php';
?>
<title>Opret nyt chatrum - Nivelo</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';
?>

<?php
if(isset($_SESSION['useruid'])){
echo "
<section class='logScale'> <!-- style='margin-top: 75px;' -->
    <div style='padding: 25px;font-size: 1.5rem;'>
        <div class='title sysText' style='text-align: center;'>Opret nyt chatrum</div>
    </div>
    <div class='modal-bodyi'>
        <form class='form' action='/db/submit/chat_submit.php' method='POST' style='background-color: var(--b);border: none;width: 450px;'>
        <!-- <label class='label' for='bruger' style='color: #818181; font-size: 16px;'>Brugernavnet på den inviterede</label> -->
        <input class='input3' type='text' required name='bruger' id='bruger' placeholder='Brugernavn (inviterede bruger)' style='margin-bottom:20px'>
        
        <!-- <label class='label' for='room_name' style='color: #818181;font-size: 18px'>Chatnavn</label> -->
        <input class='input3' autocomplete='off' type='text' required name='room_name' id='name' placeholder='Chatnavn' style='margin-bottom:20px'>
            <input type='hidden' name='user_from' value='{$_SESSION['useruid']}'>

            <div class='' style='text-align:center;'>
                <button class='modal-btn startclr' type='submit' name='submit' style='width:100%'>Lav chat</button>
            </div>
        </form>
    </div>";

?>
    
    <?php
    // INSERT INTO chat_room (name) VALUES ('My Chat Room');

        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            }
            else if($_GET["error"] == "wronglogin") {
                echo "<p>Incorrect login!</p>";
            }
        }
    ?>

<?php echo "</section>";

}

else {
    echo "</div>";
    echo "<div class='aalign'>";
    echo "<p style='margin-top: 25px;'>Log på for at oprette et nyt chatrum!</p>";

    echo "<div class='modal-spc' style='text-align:center;'>";
    echo "<a href='/login'><button class='modal-btn startclr'>Log på</button></a>";
    echo "</div>";
}


?>

<div id="preloader" class="loader"></div>




<?php
    include_once 'db/includes/footer.php';
?>

 