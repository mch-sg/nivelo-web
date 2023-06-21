<?php
session_start();

include_once 'db/includes/dbh.inc.php';

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
$stmt = $conn->prepare("SELECT usersName, company, privileges, usersColor, usersTheme FROM users WHERE usersUid = :usersUid");
$stmt->bindParam(':usersUid', $sender_id); 
$stmt->execute();
$row_color = $stmt->fetch(PDO::FETCH_ASSOC);
$userColor = htmlspecialchars($row_color['usersColor']);
$userPrivilege = htmlspecialchars($row_color['privileges']);
$userCompany = htmlspecialchars($row_color['company']);
$name = htmlspecialchars($row_color['usersName']);
$theme = htmlspecialchars($row_color['usersTheme']);


if(isset($_SESSION['useruid'])){
    echo "
    <section class='logScale'> <!-- style='margin-top: 75px;' -->


<div style='padding: 25px;font-size: 1.5rem;'>
<div class='title sysText'> 

    <h1 style='font-size:30px;margin-bottom:35px'>{$name}</h1>
    
    <div class='modal-bodyi'>
    <form class='form' action='/db/submit/profile_submit.php' method='POST' style='background-color: var(--b);border: none;width: 450px;'>
        <input minlength='6' maxlength='7' class='input3' type='text' name='color' id='color' placeholder='Skift Chatfarve ({$userColor})' style='margin-bottom:20px'>
        <input minlength='6' maxlength='7' class='input3' type='text' name='theme' id='theme' placeholder='Skift Tema ({$theme})' style='margin-bottom:20px'>
        <input class='input3' type='text' name='teamchange' autocomplete='off'  id='teamchange' placeholder='Skift Holdnavn ({$userCompany})' style='margin-bottom:20px'>
        <input class='input3' type='text' name='namechange' autocomplete='off'  id='namechange' placeholder='Skift Fulde Navn' style='margin-bottom:20px'>
     <!--   <input class='input3' type='text' name='uidchange' autocomplete='off'  id='uidchange' placeholder='Skift userId' style='margin-bottom:20px'> 
        <input class='input3' type='text' name='mailchange' id='mailchange' placeholder='Skift Email' style='margin-bottom:20px'>  -->

        <div class='modal-spc' style='text-align:center;margin-top:0'>
            <button class='startclr' type='submit' name='submit' style='width:100%;margin-top:3px;font-size: 17px'>Opdater ændringer</button>
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
    echo "<div style='text-align:center;margin-top:30px;opacity:0.25;font-weight:300;font-size:17px'><a class='hv' href='/db/includes/logout.inc.php'>Log ud</a></div>
    
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

 