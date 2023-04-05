<?php
session_start();

// Initialize the counter to 0 if it doesn't exist
if (!isset($_COOKIE['prf_c'])) {
    setcookie('prf_c', 0, time() + (86400 * 30)); // 30 days
}

// Increment the counter by 1 and update the cookie
$prf_c = $_COOKIE['prf_c'] + 1;
setcookie('prf_c', $prf_c, time() + (86400 * 30)); // 30 days
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
        if(isset($_SESSION['useruid'])){
            echo "
            <section class='logScale'> <!-- style='margin-top: 75px;' -->


    <div style='padding: 25px;font-size: 1.5rem;'>
        <div class='title sysText'> 

            <h1 style='font-size:30px;margin-bottom:35px'>{$_SESSION["username"]}</h1>
            
            <div class='modal-bodyi'>
            <form class='form' action='profile_submit.php' method='POST' style='background-color: var(--b);border: none;width: 450px;'>
                <!-- <label class='label' for='color' style='color: #414141;font-size: 15px;text-align:left'>Skift Chatfarve</label> -->
                <input minlength='7' maxlength='7' pattern='^#.*$' class='input3' type='text' name='color' id='color' placeholder='Skift Chatfarve (#b392ac)' style='margin-bottom:20px'>

                <!-- <label class='label' for='namechange' style='color: #414141;font-size: 15px;text-align:left;'>Skift Navn</label> -->
                <input class='input3' type='text' name='namechange' autocomplete='off'  id='namechange' placeholder='Skift Fulde Navn' style='margin-bottom:20px'>

                <!-- <label class='label' for='mailchange' style='color: #414141;font-size: 15px;text-align:left;'>Skift Email</label> -->
                <input class='input3' type='text' name='mailchange' id='mailchange' placeholder='Skift Email' style='margin-bottom:20px'>
    
                <div class='modal-spc' style='text-align:center;'>
                    <button class='modal-btn startclr' type='submit' name='submit'>Opdater</button>
                </div>
            </form>
            
            <!-- <div style='color:white;text-align:center'>Lys/mørk</div> -->";
            
            // $expire = time() + 60 * 60 * 24 * 365; // 1 yr 60 * 60 * 24 * 365
            // setcookie("theme_preference", "Dark", $expire, "/");
            // setcookie("chat_hex", $userColor, $expire, "/");

            if (isset($_GET['message'])) {
                $message = $_GET['message'];
                if($message == "Opdateret!"){
                    echo '<div style="color: #a2c275;font-size:18px;margin-top:50px;text-align:center">' . $message . '</div>';
                }
                else {
                    echo '<div style="color: #C27575;font-size:18px;margin-top:50px;text-align:center">' . $message . '</div>';

                }
                // #a2c275 - #818181
            }

            // echo "<div style='text-align:center;margin-top:55px;opacity:0.2;font-weight:300'><a class='pro' onclick='deleteAllCookies()'>Slet cookies<br></a></div>";
            echo "<div style='text-align:center;margin-top:45px;opacity:0.2;font-weight:300'><a class='pro' href='db/includes/logout.inc.php'>Log ud</a></div>
            
            </div>
            </div>
            </section>
            ";
            
        }
        else{
            echo "<div class='aalign'>";
            echo "<p style='margin-top: 25px;'>Du har ikke adgang! Log på for at se din profil.</p>";
        
            echo "<div class='modal-spc' style='text-align:center;'>";
            echo "<a href='/login.php'><button class='modal-btn'>Log på</button></a>";
            echo "</div>";
            echo "</div>";
        }
        ?>

        <?php

        ?>







<div id="preloader" class="loader"></div>



<?php
    include_once 'db/includes/footer.php';
?>

<link rel="stylesheet" href="css/palette-selector.css">