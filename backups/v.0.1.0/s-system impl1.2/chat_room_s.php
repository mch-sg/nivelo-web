<?php

// * Selv-lavet kode (ll. 1-37)
// *
 session_start();

$serverName = "127.0.0.1:3306";
$dBUsername = "u463909974_exam";
$dBPassword = "Ekg123321";
$dBName = "u463909974_portal";

// $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dBName", $dBUsername, $dBPassword);
} catch(PDOException $e) {
    // Handle any database connection errors
    die("Database connection failed: " . $e->getMessage());
}

include_once 'db/includes/header.php';

// Fetch data til ændring af chatnavnene
$ranid = htmlspecialchars(basename($_SERVER['REQUEST_URI']), ENT_QUOTES);
$stmt = $conn->prepare("SELECT id, name, user_from, user_to FROM chat_rooms WHERE uuid = :uuid");
$stmt->bindParam(':uuid', $ranid);
$stmt->execute();
$row3 = $stmt->fetch(PDO::FETCH_ASSOC);

$chat_room_id = $row3['id']; 
$user_from_id = $row3['user_from']; 
$user_to_id = $row3['user_to']; 
$chat_room_name = $row3['name']; 
$host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];

?>
<title><?php if($host !== 'nivelo.eu/chat_room_s' && isset($chat_room_name)) { echo htmlspecialchars($chat_room_name, ENT_QUOTES); } else { echo "Chatrum"; } ?> - Nivelo</title>
<script src="/scripts/script.js"></script>
</head>
<body>

<?php
include_once 'db/includes/nav.php';


if(isset($_SESSION['useruid'])){

// ! Lånt kode
// !
$uuid = $_SESSION['useruid'];

$stmt = $conn->prepare("SELECT DISTINCT * FROM chat_rooms WHERE (user_from = :uf OR user_to = :ut)");
$stmt->bindParam(':uf', $uuid);
$stmt->bindParam(':ut', $uuid);
$stmt->execute();
$chat_rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "

<div class='sidebar'>

<div class='sidebar-content'>

    <div class='sidebar-header'>
        <a style='pointer-events:none;opacity:0.35;font-size:13px;'>CHATRUM<br><br></a>
    </div>

    <div class='aalign' style='text-align:left;font-weight:300;'>"; /* width: 80% */

    foreach($chat_rooms as $row) {
        $chat_room_id = $row['id'];
        $chat_room_name = $row['name'];
        $user_from_id = $row['user_from'];
        $user_to_id = $row['user_to'];
        $ranid = $row['uuid'];

        if($uuid === $user_from_id || $uuid === $user_to_id) {
            echo "
            <a href='/chat_room_s/room/" . htmlspecialchars($ranid, ENT_QUOTES) . "' class='sid' style='list-style-type: none;'>" . htmlspecialchars($chat_room_name, ENT_QUOTES) . "<br><br></a>
            ";
        }
    }

    echo "
        </div>
    </div>
</div>
        ";

$ranid = htmlspecialchars(basename($_SERVER['REQUEST_URI']), ENT_QUOTES);

$stmt = $conn->prepare("SELECT * FROM chat_rooms WHERE uuid = :s");
$stmt->bindParam(':s', $ranid);
$stmt->execute();
$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
$user_from_id = $row3['user_from'];
$user_to_id = $row3['user_to'];
$chat_room_name = $row3['name'];
$chat_room_id = $row3['id'];


// * Selv-lavet kode
// *

$host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id && $host !== 'nivelo.eu/chat_room_s'){
    echo "<br><br>
    <div class='main-content' style='position: relative;'>
    <div class='chatbox-container chat-scale' style='margin-bottom: 50px;bottom: 80px;'>"; // ! Lånt chat-scale css
    echo "<div class='chatbox' id='chatbox' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>"; 

} else if ($_SESSION['useruid'] != $user_from_id || $_SESSION['useruid'] != $user_to_id && $host !== 'nivelo.eu/chat_room_s') {
    echo "<br><br>
    <div class='main-content' style='position: relative;'>
    <div class='chatbox-container chat-scale' style='margin-bottom: 0;bottom: 45px;'>"; // ! Lånt chat-scale css
    echo "<div class='chatbox' id='chatbox' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>"; 
}

if($host == 'nivelo.eu/chat_room_s'){
    echo "<br><br>
    <div class='main-content' style='position: relative;'>
    <div class='chatbox-container chat-scale' style='margin-bottom: 0;bottom: 45px;'>"; // ! Lånt chat-scale css
    echo "<div class='chatbox' id='chatbox' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>";
} 

// ! Lånt kode
// !
// Preventer forsiden chat_room.php for at vise noget
if($host == 'nivelo.eu/chat_room_s'){
    echo "Vælg et rum for at begynde, eller <a class='creat' href='/invite'> lav et nyt.</a><br>";
}

// * Selv-lavet kode (ll. 124 - +-resten)
// *

$stmt2 = $conn->prepare("SELECT * FROM messages WHERE inboxid = :inboxid");
$stmt2->bindParam(':inboxid', $chat_room_id);
$stmt2->execute();
$rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Autoriser bruger
// 
$authorized = false;
$session_user_id = $_SESSION['useruid'];
if ($session_user_id == $user_from_id || $session_user_id == $user_to_id) {
    $authorized = true;

    // Udskriv informationer til debugging
    if($host !== 'nivelo.eu/chat_room_s') {
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Chat: $chat_room_name<br></h1>";
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Bruger: $uuid<br></h1>";

        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Authorized: $user_from_id & $user_to_id<br></h1>";
        echo "<h1 style='color: #fff; opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Room: $chat_room_id<br><br><br></h1>";
    }
} 
else if (!$authorized && $host != 'nivelo.eu/chat_room_s') {
    die("Du har ikke adgang til denne chat.");
}

// Udprinter messages fra prev. LOAD
if(count($rows) > 0 && $host != 'nivelo.eu/chat_room_s') {
    foreach($rows as $row) {
        $date = new DateTime($row['timestamp']); // Tidspunkt  // ! Lånt linjekode
        $msg = nl2br(htmlspecialchars($row["message"], ENT_QUOTES)); // Splitter beskeder i multiline og undgår XSS // ! Lånt linjekode

        // Sender farver
        $sender_id = $row['user_id'];
        $stmt = $conn->prepare("SELECT usersColor FROM users WHERE usersUid = :usersUid");
        $stmt->bindParam(':usersUid', $sender_id); 
        $stmt->execute();
        $row_color = $stmt->fetch(PDO::FETCH_ASSOC);
        $userColor = htmlspecialchars($row_color['usersColor']);

        // Udskriver beskederne
        // echo "<a style='color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m H:i'). "</a> " . " " . $msg. "<br><br>"; 
        echo "<div style='line-height: 1.5;'><a style='color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m H:i'). "</a> " . " <div style='display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
    }
} else if(count($rows) == 0 && $host != 'nivelo.eu/chat_room_s') {
    // Hvis der er 0 num_rows i message databasen, men at der stadig findes 
    // beskeder i databasen, skal den sige, at der ikke er nogen beskeder endnu.
    echo "Der er ingen beskeder her endnu.";
} 

echo "
</div>
</div>
</section>
";

if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id) {
    echo "<br><br>";
    echo "<div class='fixed-input main-content'>"; // ! Lånt fixed-input css
    echo "<form class='form' method='POST' action='/db/submit/message_submit.php' style='background-color: var(--b);border: none;' >"; /* action='message_submit.php' */
    // echo "<input type='textarea' name='input' class='input5' autocomplete='off' placeholder='Skriv en besked...'/>";
    echo "<textarea type='textarea' id='messageid' name='input' class='input5' style='display:inline-block;height: 4rem' autocomplete='off' placeholder='Skriv en besked...'></textarea>";
    echo "  <input type='hidden' name='chat_room_id' value='$chat_room_id'>";
    echo "  <input type='hidden' name='chatToken' value='$ranid'>";
    echo "  <input type='hidden' name='chat_room_name' value='$chat_room_name'>";
    echo "    <button class='modal-btn sendbtn startclr' type='submit' value='Send' style='margin-left: 1%;padding: 1.25rem 0rem;border: 1px solid var(--borderclr);'>Send</button>"; /* background: #ff462e; */
    echo "</form>";
    echo "</div>";
}


} else {

echo "</div>";
echo "<div class='aalign'>";
echo "<p style='margin-top: 25px;'>Log på for at skrive og se beskeder!</p>";

echo "<div class='modal-spc' style='text-align:center;'>";
echo "<a href='/login'><button class='modal-btn startclr'>Log på</button></a>";
echo "</div>";

}

?>

</div>
<div id="preloader" class="loader"></div>

<?php
    include_once 'db/includes/footer.php';

?>

<link rel="stylesheet" href="/css/palette-selector.css">