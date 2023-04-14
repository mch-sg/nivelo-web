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


// Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['profile_visit_counter'])) {
    setcookie('profile_visit_counter', 0, time() + (86400 * 30), "/", ".nivelo.eu"); // 30 days
}

// Increment the counter by 1 and update the cookie
$profile_visit_counter = $_COOKIE['profile_visit_counter'] + 1;
setcookie('profile_visit_counter', $profile_visit_counter, time() + (86400 * 30), "/", ".nivelo.eu"); // 30 days
?>

<?php
    include_once 'db/includes/header.php';
?>
<title>Profil - Nivelo</title>
</head>
<body>

<?php
    include_once 'db/includes/nav.php';
?>


<?php 

$sender_id = $_SESSION['useruid'];
$stmt = $conn->prepare("SELECT company, privileges, usersColor FROM users WHERE usersUid = :usersUid");
$stmt->bindParam(':usersUid', $sender_id); 
$stmt->execute();
$row_color = $stmt->fetch(PDO::FETCH_ASSOC);
$userColor = htmlspecialchars($row_color['usersColor']);
$userPrivilege = htmlspecialchars($row_color['privileges']);
$userCompany = htmlspecialchars($row_color['company']);


if(isset($_SESSION['useruid'])){
    echo "
    <section class='logScale'> <!-- style='margin-top: 75px;' -->


<div style='padding: 25px;font-size: 1.5rem;'>
<div class='title sysText'> 

    <h1 style='font-size:30px;margin-bottom:35px'>{$_SESSION["username"]}</h1>
    
    <div class='modal-bodyi'>
    <form class='form' action='/db/submit/profile_submit.php' method='POST' style='background-color: var(--b);border: none;width: 450px;'>
        <input minlength='6' maxlength='7' class='input3' type='text' name='color' id='color' placeholder='Skift Chatfarve (Aktuelt: {$userColor})' style='margin-bottom:20px'>
        <input class='input3' type='text' name='teamchange' autocomplete='off'  id='teamchange' placeholder='Skift Holdnavn (Aktuelt: {$userCompany})' style='margin-bottom:20px'>
        <input class='input3' type='text' name='namechange' autocomplete='off'  id='namechange' placeholder='Skift Fulde Navn' style='margin-bottom:20px'>
        <input class='input3' type='text' name='uidchange' autocomplete='off'  id='uidchange' placeholder='Skift userId' style='margin-bottom:20px'>
        <input class='input3' type='text' name='mailchange' id='mailchange' placeholder='Skift Email' style='margin-bottom:20px'>

        <div class='modal-spc' style='text-align:center;margin-top:0'>
            <button class='startclr' type='submit' name='submit' style='width:100%;margin-top:3px'>Opdater ændringer</button>
        </div>
    </form>
    
    <!-- <div style='color:white;text-align:center'>Lys/mørk</div> -->";
    
    // $expire = time() + 60 * 60 * 24 * 365; // 1 yr 60 * 60 * 24 * 365
    // setcookie("theme_preference", "Dark", $expire, "/");
    // setcookie("chat_hex", $userColor, $expire, "/");

    if (isset($_GET['message'])) {
        $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
        $allowed_messages = array('Opdateret!');
        if (in_array($message, $allowed_messages)) {
            echo '<div style="color: #a2c275;font-size:18px;margin-top:50px;text-align:center">' . $message . '</div>';
        }
        else {
            echo '<div style="color: #C27575;font-size:18px;margin-top:50px;text-align:center">' . $message . '</div>';

        }
        // #a2c275 - #818181
    }

    // echo "<div style='text-align:center;margin-top:55px;opacity:0.2;font-weight:300'><a class='pro' onclick='deleteAllCookies()'>Slet cookies<br></a></div>";
    echo "<div style='text-align:center;margin-top:30px;opacity:0.25;font-weight:300;font-size:16px'><a class='hv' href='/db/includes/logout.inc.php'>Log ud</a></div>
    
    </div>
    </div>
    </section>
    ";
    
}
else{
    echo "<div class='aalign'>";
    echo "<p style='margin-top: 25px;'>Du har ikke adgang! Log på for at se din profil.</p>";

    echo "<div class='modal-spc' style='text-align:center;'>";
    echo "<a href='/login'><button class='startclr'>Log på</button></a>";
    echo "</div>";
    echo "</div>";
}
?>

<div id="preloader" class="loader"></div>


<?php
    include_once 'db/includes/footer.php';
?>

 