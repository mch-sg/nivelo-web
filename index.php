<?php

    include_once 'db/includes/header.php';
?>
<title>Home - Nivelo</title>
</head>

<body style=""> <!-- background-image: url('/assets/images/img.png'); background-repeat: no-repeat;background-attachment: fixed; background-size: cover; -->

<?php

    echo "<div id='preloader' class='loader'></div>";

?>

<?php
    include_once 'db/includes/nav.php';
?>

<main class="overflow-hidden aalign marleft wid" style="transform: translate(-70%, -50%);"> <!-- transform: translate(-60%, -50%);width:60%; -->

<?php 
    if(isset($_SESSION['useruid'])){
        // echo "<h1 style='text-align: left;align-items: left;'>Velkommen hos Nivelo, {$_SESSION['useruid']}</h1>";
        echo "<h1 class='drop-in pad' style='text-align: left;align-items: left'>Communicate with Nivelo, a digital chatportal for freelancers</h1>";
        // echo "<h1 class='drop-in pad' style='text-align: left;align-items: left'>Kommuniker med Nivelo, en digital chatportal</h1>";
        echo "<p class='drop-in-2 pad-xl' style='margin-top:35px;text-align:left;color: var(--modaltext);font-weight:300;width:70%;line-height:1.4;'>Enhance your communication with Nivelo. With us, you can freely communicate with your hired freelancers. We offer a simple and effective way for users to communicate, share feedback, and stay organized throughout their projects.</p>";
        echo "<a href='https://chat.nivelo.eu'><button class='startclr drop-in-3' style='margin-top: 75px;padding: 1.25rem 1.75rem;'>Get started</button></a>";
    }
    else{
        echo "<h1 class='drop-in pad' style='text-align: left;align-items: left'>Communicate with Nivelo, a digital chatportal for freelancers</h1>";
        echo "<p class='drop-in-2 pad-xl' style='margin-top:35px;text-align:left;color: #7a7a7a;font-weight:200;width:70%;line-height:1.4;'>Enhance your communication with Nivelo. With us, you can freely communicate with your hired freelancers. We offer a simple and effective way for users to communicate, share feedback, and stay organized throughout their projects.</p>";
        echo "<a href='/signup'><button class='startclr drop-in-3' style='margin-top: 75px;padding: 1.25rem 1.75rem;'>Get started</button></a>";

    }

    echo "
    </main>
        <!-- hi modal
        <div class='modal drop-in-modal' id='modal1' style='width: 500px;'>
            <div class='modal-header'>
                <div class='title'>Nyheder</div>
                <i class='bi bi-x close-button' data-accept-button></i>

            </div>
            <div class='modal-body'>

            <div class='text'><br<br> Ved at fortsætte med at bruge vores hjemmeside, accepterer du vores brug af cookies. Hvis du ønsker at ændre dine cookie-indstillinger eller slette eksisterende cookies, kan du gøre dette i din browsers indstillinger. Vær opmærksom på, at blokering eller deaktivering af cookies kan påvirke funktionaliteten og brugeroplevelsen på vores hjemmeside.</div>
            

            <!-- <br>  <a class='select hvr' data-reject-button onclick='deleteAllCookies()'><button onclick='deleteAllCookies()' class='startclr' style='width: 48%;margin-right: 1%;'>Afvis</button></a>
                <a class='select hvr' data-accept-button><button class='startclr' style='width: 48%'>Accepter</button></a> -->";
                
            echo "<!-- <br /> -->
            </div>
        </div>
        <div id='overlay1' class='drop-in-modal overlay'></div>

        <!-- Cookies modal -->
        <div class='modal drop-in-modal' id='modal' style='width: 500px;'>
            <div class='modal-header'>
                <div class='title'>We use cookies 🍪</div>
                <i class='bi bi-x close-button' data-accept-button></i>

            </div>
            <div class='modal-body'>

            <div class='text'>On our website, we use cookies to ensure the best possible user experience and to understand how our visitors use our services. Cookies are small text files that are placed on your device when you visit our website. We use cookies to remember your preferences and to deliver targeted ads based on your interests.
            </div><div class='text'><br<br> By continuing to use our website, you accept our use of cookies. If you want to delete existing cookies, you can read more on our <a class='chatlink' href='https://nivelo.eu/policy/terms-and-conditions'>Terms and Conditions</a> or our <a class='chatlink' href='https://nivelo.eu/policy/privacy-policy'>Privacy Policy</a>. Please note that blocking or disabling cookies may affect the functionality and user experience on our website.</div>
            

            <!-- <br>  <a class='select hvr' data-reject-button onclick='deleteAllCookies()'><button onclick='deleteAllCookies()' class='startclr' style='width: 48%;margin-right: 1%;'>Afvis</button></a>
                <a class='select hvr' data-accept-button><button class='startclr' style='width: 48%'>Accepter</button></a> -->";
                
            echo "<!-- <br /> -->
            </div>
        </div>
        <div id='overlay' class='drop-in-modal overlay'></div>
    ";

    // <a class='select hvr' data-close-button><button class='startclr' style='width: 48%;margin-right: 1%;'>Afvis</button></a>
    // <a class='select hvr' data-close-button><button class='startclr' style='width: 48%'>Accepter</button></a>
?>

<?php
    include_once 'db/includes/footer.php';
?>