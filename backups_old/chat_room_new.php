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
<title>Chatrum</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';

?>



<?php

if(isset($_SESSION['useruid'])){

    $uuid = $_SESSION['useruid'];
    $sql = "SELECT DISTINCT * FROM chat_rooms WHERE (user_from = '$uuid' OR user_to = '$uuid')";
    $result = mysqli_query($conn, $sql);

    echo "
    
    <div class='sidebar'>

    <div class='sidebar-content'>

        <div class='sidebar-header'>
            <a style='pointer-events:none'>Chatrum<br><br></a>
        </div>

        <div class='aalign'>";


        while($row = mysqli_fetch_assoc($result)){
            $chat_room_name = $row['name'];
            $sql = "SELECT id, user_from, user_to FROM chat_rooms WHERE name = '$chat_room_name'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $user_from_id = $row2['user_from'];
            $user_to_id = $row2['user_to'];
            if($uuid == $user_from_id || $uuid == $user_to_id) {
                $chat_room_id = $row2['id'];
                echo "
                <a href='chat_room_new.php?room=$chat_room_id' class='sid' style='list-style-type: none;'>$chat_room_name<br><br></a>
                ";
            }
        }

        echo "
            <a class='sid' style='list-style-type: none;' href='sidebar-prototype.php'>Alle<br><br></a>

            </div>
    </div>
    </div>
            
            ";
            // <a class='sid' style='list-style-type: none;' href='newchat-test.php'>Ny Chat<br><br></a>
            // <a class='sid' style='list-style-type: none;' href='chat-ui-prototype.php'>Prototype<br><br></a>
            // <a class='sid' style='list-style-type: none;' href='Chat.php'>Original</a>
}
?>

<?php
//  && $_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id

if(isset($_SESSION['useruid'])){
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

<?php

    $chat_room_id = $_GET['room'];

    $sql = "SELECT name, user_from, user_to FROM chat_rooms WHERE id = '$chat_room_id'";
    $result3 = mysqli_query($conn, $sql);
    $row3 = mysqli_fetch_assoc($result3);
    $user_from_id = $row3['user_from'];
    $user_to_id = $row3['user_to'];
    $chat_room_name= $row3['name'];

    echo "<h1 style='color: #949494C2; opacity:1.00;pointer-events: none;text-align:left;font-size:18px'>Chat: $chat_room_name<br></h1>";
    echo "<h1 style='color: #949494C2; opacity:1.00;pointer-events: none;text-align:left;font-size:18px'>Bruger: $uuid<br></h1>";

    // $sql = "SELECT id FROM chat_rooms WHERE name = '$chat_room_name'";
    // $result = mysqli_query($conn, $sql);

    // if(mysqli_num_rows($result) == 0) {
    //     header("location: chat_room.php");
    //     exit();
    // }
    // $row = mysqli_fetch_assoc($result);
    // $chat_room_id = $row['id'];



    // Load MESSAGES
    $sql = "SELECT * FROM messages WHERE inboxid = '$chat_room_id'";
    $result = mysqli_query($conn, $sql);

    // Udskriv informationer til debugging
    echo "<h1 style='color: #949494C2; opacity:1.00;pointer-events: none;text-align:left;font-size:18px'>Authorized: $user_from_id & $user_to_id<br></h1>";
    echo "<h1 style='color: #949494C2; opacity:1.00;pointer-events: none;text-align:left;font-size:18px'>Room: $chat_room_id<br><br><br></h1>";

    // Autoriser til debug
    $authorized = false;
    if (isset($_SESSION['useruid'])) {
        $session_user_id = $_SESSION['useruid'];
        if ($session_user_id == $user_from_id || $session_user_id == $user_to_id) {
            $authorized = true;
        }
    }
    // if (!$authorized) {
    //     die("You are not authorized to view this page.");
    // }


    // Udprinter messages fra prev. LOAD
    if($result->num_rows > 0) {

        // Verificere, at session bruger er den samme som en bruger fra chatten
        // ellers skal den ikke vise beskederne, men i stedet skrive, at de ikke 
        // har adgang til chatten.
        if($uuid == $user_from_id || $uuid == $user_to_id){ /* $uuid = $user_from_id || $uuid = $user_to_id */
            while($row = $result->fetch_assoc()) {
                // echo "".$row["user_id"]. " " ."- " . $row["message"]. "<br><br>";

                $date = new DateTime($row['timestamp']); // Tidspunkt  
                $msg = nl2br($row["message"]); // Splitter beskeder i multiline
                // Udskriver beskederne
                echo "<a style='color: #ff6e5ac2; opacity:1.00;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.30;pointer-events: none;'>(" . $date->format('M. d \k\l. H:i'). "):</a> " . "</a>" . $msg. "<br><br>"; 
            } 
        } else {
            // Hvis personen ikke matcher session $uuid med en fra chatten,
            // Skal den skrive, at du ikke har adgang
            echo "Du har ikke adgang til denne chat.";
        }
    } else if ($uuid != $user_from_id || $uuid != $user_to_id) {
        // Hvis der er 0 num_rows i message databasen, men brugeren stadig ikke
        // Har adgang til chatten, så skal den vise, at du ikke har adgang
        echo "Du har ikke adgang til denne chat.";
    } else {
        // Hvis der er 0 num_rows i message databasen, men at der stadig findes 
        // beskeder i databasen, skal den sige, at der ikke er nogen beskeder endnu.
        echo "Der er ingen beskeder her endnu.";
    }

    $conn->close();
?>


</div>
</div>
</section>



<?php



if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id){
    echo "<br><br>";
    echo "<div class='fixed-input main-content'>";
    echo "<form class='form' method='POST' action='message_submit.php' style='background-color: var(--b);border: none;' >"; /* action='message_submit.php' */
    // echo "<input type='textarea' name='input' class='input5' autocomplete='off' placeholder='Skriv en besked...'/>";
    echo "<textarea type='textarea' id='input' name='input' class='input5' style='display:inline-block;height: 4rem' autocomplete='off' placeholder='Skriv en besked...'></textarea>";
    echo "  <input type='hidden' name='chat_room_id' value='$chat_room_id'>";
    echo "  <input type='hidden' name='chat_room_name' value='$chat_room_name'>";
    echo "    <button class='modal-btn' type='submit' value='Send' style='margin-left: 1%;padding: 1.25rem 0rem;width: 10%;border: 1px solid var(--borderclr);'>Send</button>"; /* background: #ff462e; */
    echo "</form>";
    echo "</div>";
}
else if (!isset($_SESSION['useruid'])) {
    echo "<div class='aalign'>";
    echo "<p style='margin-top: 25px;'>Log på for at skrive og se beskeder!</p>";

    echo "<div class='modal-spc' style='text-align:center;'>";
    echo "<a href='/login.php'><button>Log på</button></a>";
    echo "</div>";
    echo "</div>";
} else if ($_SESSION['useruid'] != $user_from_id || $_SESSION['useruid'] != $user_to_id) {
    echo "<div class='aalign'>";
    // echo "<p style='margin-top: 25px;'>Du har ikke adgang til denne chat!</p>";
    echo "</div>";
}

?>



</div>
<div id="preloader" class="loader"></div>


<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">