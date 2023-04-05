<?php

// * Selv-lavet kode (ll. 1-37)
// *
session_start();


$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
?>


<?php
    include_once 'db/includes/header.php';

    // Fetch data til ændring af chatnavnene
    $chat_room_id = $_GET['room']; $sql = "SELECT name, user_from, user_to FROM chat_rooms WHERE id = '$chat_room_id'"; $result3 = mysqli_query($conn, $sql); $row3 = mysqli_fetch_assoc($result3); $user_from_id = $row3['user_from']; $user_to_id = $row3['user_to']; $chat_room_name= $row3['name']; $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];  
?>
<title><?php if($host != 'devmch.online/chat_room.php') { echo $chat_room_name; } else { echo "Chatrum"; } ?> - Nivelo</title>
<script src="/scripts/script.js"></script>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';

?>



<?php

if(isset($_SESSION['useruid'])){

    // ! Lånt kode (ll. 40-69)
    // !
    $uuid = $_SESSION['useruid'];
    $sql = "SELECT DISTINCT * FROM chat_rooms WHERE (user_from = '$uuid' OR user_to = '$uuid')";
    $result = mysqli_query($conn, $sql);

    echo "
    
    <div class='sidebar'>

    <div class='sidebar-content'>

        <div class='sidebar-header'>
            <a style='pointer-events:none;opacity:0.35;font-size:13px;'>CHATRUM<br><br></a>
        </div>

        <div class='aalign' style='text-align:left;font-weight:300;'>"; /* width: 80% */

        // Fetch chat room blandt id og indsættes i chat_room
        while($row = mysqli_fetch_assoc($result)){
            $chat_room_name = $row['name'];
            $sql = "SELECT id, user_from, user_to, uuid FROM chat_rooms WHERE name = '$chat_room_name'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $user_from_id = $row2['user_from'];
            $user_to_id = $row2['user_to'];
            if($uuid == $user_from_id || $uuid == $user_to_id) {
                $chat_room_id = $row2['id'];
                $ranid = $row2['uuid'];
                echo "
                <a href='chat_room.php?room=$chat_room_id' class='sid' style='list-style-type: none;'>$chat_room_name<br><br></a>
                ";
            }
        }

        // * Selv-lavet kode (ll. 70-115)
        // *
        echo "
            </div>
        </div>
    </div>
            ";
            // <a class='sid' style='list-style-type: none;opacity:0.35' href='invite.php'>+<br><br></a>
}
?>

<?php
if(isset($_SESSION['useruid'])){
    echo "
    
    <br><br>
    
    <div class='main-content' style='position: relative;'>
    <div class='chatbox-container chat-scale'>"; // ! Lånt chat-scale css
    echo "<div class='chatbox' id='chatbox' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>
    
    ";
    // <section class='signup-form aalign main-content'>
}
else{

}

?>

<?php

    // ! Lånt kode (ll. 106-119)
    // !
    $chat_room_id = $_GET['room'];

    $sql = "SELECT name, user_from, user_to FROM chat_rooms WHERE id = '$chat_room_id'";
    $result3 = mysqli_query($conn, $sql);
    $row3 = mysqli_fetch_assoc($result3);
    $user_from_id = $row3['user_from'];
    $user_to_id = $row3['user_to'];
    $chat_room_name = $row3['name'];

    // Preventer forsiden chat_room.php for at vise noget
    $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
    if($host == 'devmch.online/chat_room.php' && $_SESSION['useruid']){
        echo "<h1 style='opacity:1.00;pointer-events: none;text-align:left;font-size:18px'>Vælg et rum for at begynde.<br></h1>";
    }

    // * Selv-lavet kode (ll. 124 - +-resten)
    // *
    // Udskriv informationer til debugging
    if(isset($_SESSION['useruid']) && $host != 'devmch.online/chat_room.php') {
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Chat: $chat_room_name<br></h1>";
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Bruger: $uuid<br></h1>";
    }

    // Load MESSAGES
    $sql = "SELECT * FROM messages WHERE inboxid = '$chat_room_id'";
    $result = mysqli_query($conn, $sql);

    // Udskriv informationer til debugging
    if(isset($_SESSION['useruid']) && $host != 'devmch.online/chat_room.php') {
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Authorized: $user_from_id & $user_to_id<br></h1>";
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Room: $chat_room_id<br><br><br></h1>";
    }

    // Udprinter messages fra prev. LOAD
    if($result->num_rows > 0 && isset($_SESSION['useruid'])  && $host != 'devmch.online/chat_room.php') {

        // Verificere, at session bruger er den samme som en bruger fra chatten
        // ellers skal den ikke vise beskederne, men i stedet skrive, at de ikke 
        // har adgang til chatten.
        if($uuid == $user_from_id || $uuid == $user_to_id){
            while($row = $result->fetch_assoc()) {
                // echo "".$row["user_id"]. " " ."- " . $row["message"]. "<br><br>";

                date_default_timezone_set("Europe/Copenhagen");
                $date = new DateTime($row['timestamp']); // Tidspunkt  // ! Lånt linjekode
                $msg = nl2br($row["message"]); // Splitter beskeder i multiline // ! Lånt linjekode

                // Sender farver
                $sender_id = $row['user_id']; // Sender ID
                $sql = "SELECT usersColor FROM users WHERE usersUid = '$sender_id'";
                $result_color = mysqli_query($conn, $sql);
                $row_color = mysqli_fetch_assoc($result_color);
                $userColor = $row_color['usersColor'];

                // Udskriver beskederne
                echo "<a style='color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m H:i'). "</a> " . " " . $msg. "<br><br>"; 
                // echo "<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m/y H:i'). "</a> " ."<a style='color: $userColor; opacity:1.00;pointer-events: none;'>".$row["user_id"]. "</a>" . "   " . $msg. "<br><br>";
                
                // echo "<a style='color: $userColor; opacity:1.00;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.30;pointer-events: none;'>(" . $date->format('M. d \k\l. H:i'). ")</a> " . "</a>" . $msg. "<br><br>"; 
            } 
        } else {
            // Hvis personen ikke matcher session $uuid med en fra chatten,
            // Skal den skrive, at du ikke har adgang
            echo "Du har ikke adgang til denne chat.";
        }
    } else if($result->num_rows == 0) {
        // Hvis der er 0 num_rows i message databasen, men at der stadig findes 
        // beskeder i databasen, skal den sige, at der ikke er nogen beskeder endnu.
        echo "<p style='color:white;font-weight:300'>Der er ingen beskeder her endnu.</p>";

    } 

    $conn->close();
?>

</div>
</div>
</section>

<?php

if(isset($_SESSION['useruid'])){
    if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id) {
        echo "<br><br>";
        echo "<div class='fixed-input main-content'>"; // ! Lånt fixed-input css
        echo "<form class='form' method='POST' action='message_submit.php' style='background-color: var(--b);border: none;' >"; /* action='message_submit.php' */
        // echo "<input type='textarea' name='input' class='input5' autocomplete='off' placeholder='Skriv en besked...'/>";
        echo "<textarea type='textarea' id='messageid' name='input' class='input5' style='display:inline-block;height: 4rem' autocomplete='off' placeholder='Skriv en besked...'></textarea>";
        echo "  <input type='hidden' name='chat_room_id' value='$chat_room_id'>";
        echo "  <input type='hidden' name='chat_room_name' value='$chat_room_name'>";
        echo "    <button class='modal-btn sendbtn startclr' type='submit' value='Send' style='margin-left: 1%;padding: 1.25rem 0rem;border: 1px solid var(--borderclr);'>Send</button>"; /* background: #ff462e; */
        echo "</form>";
        echo "</div>";
    }
}
else {
    echo "<div class='aalign'>";
    echo "<p style='margin-top: 25px;'>Log på for at skrive og se beskeder!</p>";

    echo "<div class='modal-spc' style='text-align:center;'>";
    echo "<a href='/login.php'><button class='modal-btn'>Log på</button></a>";
    echo "</div>";
    echo "</div>";
} 

?>

</div>
<div id="preloader" class="loader"></div>

<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">