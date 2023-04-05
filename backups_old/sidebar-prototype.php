
<?php

session_start();

$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
?>


<?php
    include_once 'db/includes/header.php';
    
?>
<title>Prot.Chatting</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';

?>


<?php

if(isset($_SESSION['useruid'])){

    echo "
    
    <div class='sidebar'>
    <!-- Sidebar content goes here -->

    <div class='sidebar-content'>

        <div class='sidebar-header'>
            <a style='pointer-events:none'>Chatrum<br><br></a>
        </div>

        <div class='aalign'>
            <a class='sid' style='list-style-type: none;' href='sidebar-prototype.php'>Alle<br><br></a>
            <a class='sid' style='list-style-type: none;' href='newchat-test.php'>Ny Chat<br><br></a>
            <a class='sid' style='list-style-type: none;' href='chat-ui-prototype.php'>Prototype<br><br></a>
            <a class='sid' style='list-style-type: none;' href='Chat.php'>Original</a>
        </div>
    </div>
    </div>
    
    ";


    echo "
    
    <br><br>
    
    <div class='main-content'>
    <div class='main-content-content chatbox-container'>
    <div class='chatbox' style='font-weight: 300;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>
    
    ";
    // <section class='signup-form aalign main-content'>
}
else{

}

?>

<!-- <div class="main-content">
    <section class="signup-form aalign main-content">
        <div class="main-content-content chatbox-container">
            <div class="chatbox" style="color:white;width: 600px; white-space: normal; overflow: auto; word-wrap: break-word;"> -->
            <!-- <div class="title sysText" style="text-align: center;">Chat</div> -->
            <?php
                // $sql = "SELECT 'message' FROM chat1";
                $sql = "SELECT * FROM messages";
                $result = $conn->query($sql); // mysqli_query($conn, $sql)

                if($result->num_rows > 0 && isset($_SESSION['useruid'])) {
                    while($row = $result->fetch_assoc()) {
                        // echo "".$row["user_id"]. " " ."- " . $row["message"]. "<br><br>";

                        $date = new DateTime($row['timestamp']) ;  
                        // echo $date->format('Y-m-d');
                        // echo "<a style='opacity:0.7'>".$row["user_id"]. " " ."(" . $date->format('H:i'). ") " . "- </a>";
                        // echo ""$row["message"]. "<br><br>";

                        $msg = nl2br($row["message"]);
                        echo "<a style='color: #ff6e5ac2; opacity:1.00;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.30;pointer-events: none;'>(" . $date->format('M. d \k\l. H:i'). "):</a> " . "</a>" . $msg. "<br><br>";
                    }
                } else if (!isset($_SESSION['useruid'])) {
                    echo "";
                } else {
                    echo "Der er ingen beskeder her endnu.";
                }
                $conn->close();
            ?>
            </div>
        </div>

    </section>

    <?php

    if(isset($_SESSION['useruid'])){
        echo "<br><br>";
        echo "<div class='fixed-input main-content'>";
        echo "<form class='form' method='POST' action='message_submit.php' style='background-color: var(--b);border: none;' >";
        // echo "<input type='textarea' name='input' class='input5' autocomplete='off' placeholder='Skriv en besked...'/>";
        echo "<textarea type='textarea' id='input' name='input' class='input5' style='display:inline-block;height: 4rem' autocomplete='off' placeholder='Skriv en besked...'></textarea>";
        echo "    <button class='modal-btn' type='submit' value='Send' style='margin-left: 1%;padding: 1.25rem 0rem;width: 10%;border: 1px solid var(--borderclr);'>Send</button>"; /* background: #ff462e; */
        echo "</form>";
        echo "</div>";
    }
    else{
        echo "<div class='aalign'>";
        echo "<p style='margin-top: 25px;'>Log på for at skrive og se beskeder!</p>";

        echo "<div class='modal-spc' style='text-align:center;'>";
        echo "<a href='/login.php'><button>Log på</button></a>";
        echo "</div>";
        echo "</div>";
    }

    ?>



</div>


<div id="preloader" class="loader"></div>
<!-- <footer class="footer" style="position:fixed;">

<p class="copy">© Webportal by <a href="https://" target="_blank"> Magnus Hvidtfeldt</a></p>

</footer> -->



<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">