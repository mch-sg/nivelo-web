<?php

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

include_once '../db/includes/header.php';

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
<title><?php if($host !== 'chat.nivelo.eu/' && isset($chat_room_name)) { echo htmlspecialchars($chat_room_name, ENT_QUOTES); } else { echo "Chatrum"; } ?> - Nivelo</title>
<script src="https://nivelo.eu/scripts/script.js"></script>
</head>
<body id='body'>

<?php
include_once '../db/includes/nav.php';


if(isset($_SESSION['useruid'])){

$uuid = $_SESSION['useruid'];

$stmt = $conn->prepare("SELECT DISTINCT * FROM chat_rooms WHERE (user_from = :uf OR user_to = :ut)");
$stmt->bindParam(':uf', $uuid);
$stmt->bindParam(':ut', $uuid);
$stmt->execute();
$chat_rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $stmt = $pdo->prepare("SELECT chat_rooms.*, MAX(messages.timestamp) AS last_message_timestamp
//                        FROM chat_rooms
//                        LEFT JOIN messages ON chat_rooms.id = messages.inboxid 
//                        WHERE (user_from = :uf OR user_to = :ut)
//                        GROUP BY chat_rooms.id
//                        ORDER BY last_message_timestamp DESC");

// $stmt->bindParam(':uf', $uuid_param);
// $stmt->bindParam(':ut', $uuid_param);
// $uuid_param = $uuid;
// $stmt->execute();

// $chat_rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "

<div class='sidebar'>

<div class='sidebar-content'>



<div id='sidebar' class='aalign' style='text-align:left;font-weight:300;width:100%;padding:25%;'>
<a style='pointer-events:none;opacity:0.35;font-size:13px;font-weight:200;'>CHATRUM<br><br></a>"; 

    foreach($chat_rooms as $row) {
        $chat_room_id = $row['id'];
        $chat_room_name = $row['name'];
        $user_from_id = $row['user_from'];
        $user_to_id = $row['user_to'];
        $ranid = $row['uuid'];

        if($uuid === $user_from_id || $uuid === $user_to_id) {
            echo "
            <a href='/room/" . htmlspecialchars($ranid, ENT_QUOTES) . "' class='sid' style='list-style-type: none;'><i class='bi bi-hash i-a' style='vertical-align: bottom;margin-right: 5px;font-size:19px'></i>" . htmlspecialchars($chat_room_name, ENT_QUOTES) . "</a><br><br>
            ";
        }
    }

    echo "
        </div>
    </div>
</div>
        ";

// $ranid = htmlspecialchars($_GET['room'], ENT_QUOTES);
$ranid = htmlspecialchars(basename($_SERVER['REQUEST_URI']), ENT_QUOTES);

$stmt = $conn->prepare("SELECT * FROM chat_rooms WHERE uuid = :s");
$stmt->bindParam(':s', $ranid);
$stmt->execute();
$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
$user_from_id = $row3['user_from'];
$user_to_id = $row3['user_to'];
$chat_room_name = $row3['name'];
$chat_room_id = $row3['id'];

$host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];

echo "<br><br>
<div class='main-content' style='position: relative;'>
<div id='chatbox'>";
if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id && $host !== 'chat.nivelo.eu/'){
    echo "<div class='chatbox-container chat-scale' style='margin-bottom: 50px;bottom: 80px;'>";  
    echo "<div class='chatbox' id='chatside' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>"; 
    
    $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];

} 
else if ($_SESSION['useruid'] != $user_from_id || $_SESSION['useruid'] != $user_to_id && $host !== 'chat.nivelo.eu/') {
    echo "
    <div class='chatbox-container chat-scale' style='margin-bottom: 0;bottom: 45px;'>"; 
    echo "<div class='chatbox'  id='chatside' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>"; 
}
    
if($host == 'chat.nivelo.eu/'){
    echo "
    <div class='chatbox-container chat-scale'style='margin-bottom: 0;bottom: 45px;'>"; 
    echo "<div class='chatbox'  style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>";
} 



// Preventer forsiden chat_room.php for at vise noget
if($host == 'chat.nivelo.eu/'){
    echo "Vælg et rum for at begynde, eller <a class='creat' href='https://nivelo.eu/invite'> lav et nyt.</a><br>";
}


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
    if($host !== 'chat.nivelo.eu/') {
        echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Chat: $chat_room_name<br></h1>";
        // echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Bruger: $uuid<br></h1>";

        echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Authorized: $user_from_id & $user_to_id<br></h1>";
        echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Token: $ranid<br><br><br></h1>";
    }
} 
else if (!$authorized && $host !== 'chat.nivelo.eu/') {
    die("Du har ikke adgang til denne chat.");
}

// Udprinter messages fra prev. LOAD
if(count($rows) > 0 && $host != 'chat.nivelo.eu/') {
    foreach($rows as $row) {
            $date = new DateTime($row['timestamp']); // Tidspunkt  

            $msg = htmlspecialchars($row["message"], ENT_QUOTES); // Splitter beskeder i multiline og undgår XSS
            $msg = nl2br($msg);
            $msg = preg_replace('/(<\/?\w+(?:(?!<\/?\w+>).)*>|^)\K((?:https?:\/\/)[^\s<>"\']+(?:\([\w\d]+\)|[^<>"\'()\[\]\s]))/i', '$1<a class="chatlink" href="$2" target="_blank" rel="noopener noreferrer">$2</a>', $msg);

            // Sender farver
            $sender_id = $row['user_id']; // Sender ID

            $stmt = $conn->prepare("SELECT usersColor FROM users WHERE usersUid = :usersUid");
            $stmt->bindParam(':usersUid', $sender_id); 
            $stmt->execute();
            $row_color = $stmt->fetch(PDO::FETCH_ASSOC);
            $userColor = htmlspecialchars($row_color['usersColor']);

        // Udskriver beskederne
        // echo "<a style='color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m H:i'). "</a> " . " " . $msg. "<br><br>"; 
        echo "<div class='chatmsg' style='line-height: 1.5;'><a style='color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m H:i'). "</a> " . " <div style='display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
    }
} else if(count($rows) == 0 && $host != 'chat.nivelo.eu/') {
    // Hvis der er 0 num_rows i message databasen, men at der stadig findes 
    // beskeder i databasen, skal den sige, at der ikke er nogen beskeder endnu.
    echo "Der er ingen beskeder her endnu.";
} 

echo "
</div>
</div>
</section>
";

echo "<div class='fixed-input main-content' id='subform'>";
if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id) {
    // echo "<br><br>";
    echo "<form class='form' method='POST' id='formbi' action='/submit/message_submit.php' style='background-color: var(--b);border: none;' >"; /* action='message_submit.php' */
    // echo "<input type='textarea' name='input' class='input5' autocomplete='off' placeholder='Skriv en besked...'/>";

    echo "<textarea type='textarea' id='messageid' name='input' class='input5' style='display:inline-block;height: 4rem' autocomplete='off' placeholder='Skriv en besked...'></textarea>";

    echo "  <input type='hidden' name='chat_room_id' value='$chat_room_id'>";
    echo "  <input type='hidden' name='chatToken' value='$ranid'>";
    echo "  <input type='hidden' name='chat_room_name' value='$chat_room_name'>";

    // echo "    <button class='modal-btn sendbtn startclr' type='submit' value='Send' style='margin-left: 1%;padding: 1.25rem 0rem;border: 1px solid var(--borderclr);'>";

    echo "
    <button type='submit' value='Send' style='border:none;background:none'>
    <i class='fa-regular fa-paper-plane fa-xl icon-placement' style='
        float: right;
        position: absolute;
        background: none;
        color: #ffffff;
        align-items: flex-end;
        top: 32.5px;
    '></i>
    
    </button>"; /* background: #ff462e; */
    echo "</form>";
    echo "</div>";
}


} else {

echo "</div>";
echo "<div class='aalign'>";
echo "<p style='margin-top: 25px;'>Log på for at skrive og se beskeder!</p>";

echo "<div class='modal-spc' style='text-align:center;'>";
echo "<a href='https://nivelo.eu/login'><button class='modal-btn startclr'>Log på</button></a>";
echo "</div>";

}

?>

</div>
<div id="preloader" class="loader"></div>
<script src="https://nivelo.eu/scripts/scroll.js"></script>
<script src="https://nivelo.eu/scripts/chat.js"></script>

<?php
    include_once '../db/includes/footer.php';

?>

 
