<?php

session_start();

include_once '../db/includes/dbh.inc.php';

include_once '../db/includes/header.php';
?>
<title id='titlename'> <?php
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
<?php if($host !== 'chat.nivelo.eu/' && isset($chat_room_name)) { echo htmlspecialchars($chat_room_name, ENT_QUOTES); } else { echo "Chatrum"; } ?> - Nivelo</title>
<script src="/scripts/dynamic-page-loading-nav.js"></script>
<script src="https://nivelo.eu/scripts/script.js"></script>
</head>
<body id='body'>


<script type="text/javascript">
    localStorage.clear();
</script>


<header id="header" class="head" style="height:85px;background:#101010">
    <a class="h-logo pro" href="https://nivelo.eu" style=" font-size: 16px; transition: 0.1s ease;">
        <div class="hv">
            <img style="vertical-align: middle;margin-left: 15px;" src="https://nivelo.eu/assets/icons/nivelo-2.svg" width="95px"></img>
        </div>
    </a>

    
<nav>
  <ul class="nav_links_chat" style="font-weight:400;">
    <?php
        if(isset($_SESSION["useruid"])){
            echo "<a href='javascript:void(0);' onclick='myFunction()' id='p2' class='icon divb bi bi-chevron-down'> </a></li>";
            
            echo "<div class='disc' id='navlink' style='z-index: 1000;'>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://nivelo.eu/invite'>Create new room</a></li>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://chat.nivelo.eu'>Chatrooms</a></li>";
            echo "<li id='brd2' class='brd' style='vertical-align: middle;text-align: center;border-left: 1px solid var(--borderclr); height: 35px; margin: 0 0 0 20px;'></li>";
            // echo "<li><a class='pro nlink' style='vertical-align: middle;pointer-events:none;opacity:0.25' >{$_SESSION["useruid"]}</a> ";
            
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://nivelo.eu/profile'>Account </a><a style='vertical-align: middle;pointer-events:none;opacity:0.25'>({$_SESSION["useruid"]})</a> ";

            echo "<li>
            <a class='pro nlink' style='vertical-align: middle;' id='newli2'>
            <i data-modal-target='#modal' class='fa-solid fa-gear' style='vertical-align: revert;font-size: 17px;'></i> </a>
            </li>";

        }
        else {
            echo "<a href='javascript:void(0);' onclick='myFunction()' id='p2' class='icon divb bi bi-chevron-down'> </a></li>";

            echo "<div class='disc' id='navlink' style='z-index: 1000;'>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='/about'>About</a></li>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://chat.nivelo.eu'>Chatrooms</a></li>";
            // echo "<li><a class='pro' style='vertical-align: middle;' href='//pro'>Gå Pro</a></li>";
            echo "<li id='brd2' class='brd' style='vertical-align: middle;text-align: center;border-left: 1px solid var(--borderclr); height: 35px; margin: 0 0 0 20px;'></li>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://nivelo.eu/login'>Sign in</a></li>";
            echo "<li><a class='modal-btn-header nlink' href='https://nivelo.eu/signup' style='vertical-align: middle;padding: 1rem 1.5rem;'>Sign up</a></li> </div>";
            
        }
    ?>
  </ul>
</nav>


<script>
function myFunction() {
  var x = document.getElementById("navlink");
  if (x.className === "disc") {
    x.className += " responsive";
  } else {
    x.className = "disc";
  }

  var y = document.getElementById("brd2");
  if (y.className === "brd") {
    y.className += " disp";
  } else {
    y.className = "brd";
  }
}
</script>


</header>



<?php

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

<div class='sidebar' style='background:#101010'>

<div class='sidebar-content'>



<div id='sidebar' class='aalign' style='text-align:left;font-weight:300;width:100%;padding:25%;top: 45%;'>
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
    <a href='https://nivelo.eu/invite' class='sidadd' style='list-style-type: none;'>
    <i class='fa-sharp fa-thin fa-plus i-a' style='margin-left: 2px;vertical-align: text-bottom;margin-right: 5px;font-size: 18px;'></i>
    Add room</a>

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
    echo "<div class='chat-scale' style='margin-bottom: 50px;bottom: 85px;overflow-y: auto;width:auto'>";  // 50px
    echo "<div class='chatbox' id='chatside' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>"; 
    
    $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];

} 
else if ($_SESSION['useruid'] != $user_from_id || $_SESSION['useruid'] != $user_to_id && $host !== 'chat.nivelo.eu/') {
    echo "
    <div class='chat-scale' style='margin-bottom: 0;bottom: 45px;overflow-y: auto;width:auto'>"; 
    echo "<div class='chatbox'  id='chatside' style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>"; 
}
    
if($host == 'chat.nivelo.eu/'){
    echo "
    <div class='chat-scale'style='margin-bottom: 0;bottom: 45px;overflow-y: auto;width:auto'>"; 
    echo "<div class='chatbox'  style='font-weight: 200;color:white; white-space: normal; overflow: auto; word-wrap: break-word;'>";
} 



// Preventer forsiden chat_room.php for at vise noget
if($host == 'chat.nivelo.eu/'){
    echo "<div style='padding:30px'>Vælg et rum for at begynde, eller <a class='creat' href='https://nivelo.eu/invite'> lav et nyt.</a><br></div>";
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
        echo "<div>
        <h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px;padding: 30px 30px 0px 30px;'># $chat_room_name</h1>";
        // echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Bruger: $uuid<br></h1>";

        echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px;padding: 0px 30px 30px 30px;'>$user_from_id & $user_to_id ";
        echo "</h1></div>
        <div style='
        border-top: 1px solid var(--borderclr);
        width: 100%;'></div>
        <br>";

        // echo "<h1 style='opacity:0.25;font-weight:200;pointer-events: none;text-align:left;font-size:18px'>Token: $ranid<br><br><br></h1>";
    }
} 
else if (!$authorized && $host !== 'chat.nivelo.eu/') {
    die("<div style='padding:30px'>Du har ikke adgang til denne chat.</div>");
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

            $stmt = $conn->prepare("SELECT company, privileges, usersColor FROM users WHERE usersUid = :usersUid");
            $stmt->bindParam(':usersUid', $sender_id); 
            $stmt->execute();
            $row_color = $stmt->fetch(PDO::FETCH_ASSOC);
            $userColor = htmlspecialchars($row_color['usersColor']);
            $userPrivilege = htmlspecialchars($row_color['privileges']);
            $userCompany = htmlspecialchars($row_color['company']);

            if($userColor !== "") {
                $newColor = substr($userColor, 1);
            } else {
                $newColor = ffffff;
            }

            // ! Udskriver beskederne
            // ! med PRIVILEGIER
            // ! uden FIRMA
            if($userPrivilege === "admin" && $userCompany !== "") {
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<i class='fa-regular fa-badge-check' style='font-size: 14px;margin-left:5px;margin-right: 3px;'></i><a style='margin-right: 5px;padding: 2px 8px;background: #202020;color: #8f8f8f;font-size:15px;font-weight:300;pointer-events: none;margin-left: 5px;border-radius: 5px;'>$userCompany</a></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            } 
            else if($userPrivilege === "moderator" && $userCompany !== "") {
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<i class='fa-solid fa-shield-check' style='font-size: 14px;margin-left:5px;margin-right: 3px;'></i><a style='margin-right: 5px;padding: 2px 8px;background: #202020;color: #8f8f8f;font-size:15px;font-weight:300;pointer-events: none;margin-left: 5px;border-radius: 5px;'>$userCompany</a></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            } 
            else if($userPrivilege === "vip" && $userCompany !== "") {
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<i class='fa-solid fa-asterisk' style='font-size: 14px;margin-left:5px;margin-right: 3px;'></i><a style='margin-right: 5px;padding: 2px 8px;background: #202020;color: #8f8f8f;font-size:15px;font-weight:300;pointer-events: none;margin-left: 5px;border-radius: 5px;'>$userCompany</a></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            } 
            
            else if ($userCompany !== "") {
                // !
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<a style='margin-right: 5px;padding: 2px 8px;background: #202020;color: #8f8f8f;font-size:15px;font-weight:300;pointer-events: none;margin-left: 5px;border-radius: 5px;'>$userCompany</a></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            }

            // ? Udskriver beskederne
            // ? med PRIVILEGIER
            // ? med FIRMA
            if($userPrivilege === "admin" && $userCompany == "") {
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<i class='fa-regular fa-badge-check' style='font-size: 14px;margin-left:5px;margin-right: 3px;'></i></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            } 
            else if($userPrivilege === "moderator" && $userCompany == "") {
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<i class='fa-solid fa-shield-check' style='font-size: 14px;margin-left:5px;margin-right: 3px;'></i></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            } 
            else if($userPrivilege === "vip" && $userCompany == "") {
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "<i class='fa-solid fa-asterisk' style='font-size: 14px;margin-left:5px;margin-right: 3px;'></i></a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            } 
            
            else if ($userCompany == "") {
                // ?
                echo "<div class='chatmsg' style='line-height: 1.5;padding: 0px 30px 5px 30px;'>
                
                <img src='https://ui-avatars.com/api/?background=$newColor&name=$sender_id' style='margin-top: 5px;position: absolute;border-radius: 5px;' width='40px'>
                
                <a style='margin-left: 50px;color: $userColor; font-weight:300;pointer-events: none;'>".$row["user_id"]. "</a> " ."<a style='opacity:0.15;pointer-events: none;font-weight:200'>" . $date->format('d/m'). "</a><br> " . " <div style='margin-left: 50px;display: inline-grid;margin-bottom: 15px;'>" . $msg. "</div><br></div>";
            }
    }
} else if(count($rows) == 0 && $host != 'chat.nivelo.eu/') {
    // Hvis der er 0 num_rows i message databasen, men at der stadig findes 
    // beskeder i databasen, skal den sige, at der ikke er nogen beskeder endnu.
    echo "<div style='margin-left: 25px'>Der er ingen beskeder her endnu.</div>";
} 

echo "<br>
</div>
</div>
</section>
";

echo "<div class='fixed-input main-content' id='subform' style='bottom: 85px;'>";
if($_SESSION['useruid'] == $user_from_id || $_SESSION['useruid'] == $user_to_id) {
    // echo "<br><br>";
    echo "<form class='form' method='POST' id='formbi' name='formbi' action='/submit/message_submit.php' style='background-color: var(--b);border: none;' >"; /* action='message_submit.php' */
    // echo "<input type='textarea' name='input' class='input5' autocomplete='off' placeholder='Skriv en besked...'/>";

    echo "<textarea oninput='checkInput()' type='textarea' id='messageid' name='input' class='input5' style='display:inline-block;height: 7rem' autocomplete='off' placeholder='Message # $chat_room_name'></textarea>";

    echo "  <input type='hidden' name='chat_room_id' value='$chat_room_id'>";
    echo "  <input type='hidden' name='chatToken' value='$ranid'>";
    echo "  <input type='hidden' name='chat_room_name' value='$chat_room_name'>";

    echo "
    <button type='submit' id='msgbtn' value='Send' style='border:none;background:none' disabled>
    <i id='iconbtn' class='fa-regular fa-paper-plane-top fa-xl icon-placement' style='
        font-weight:900;
        float: right;
        position: absolute;
        background: none;
        align-items: flex-end;
        top: 5.2rem;
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
echo "<a href='https://nivelo.eu/login'><button class='startclr'>Log på</button></a>";
echo "</div>";

}

?>

</div>
</div>



<div id="preloader" class="loader"></div>
<script src="/scripts/scroll.js"></script>
<script src="/scripts/chat.js"></script>

<?php
    include_once '../db/includes/footer.php';

?>

