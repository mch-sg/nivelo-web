<?php

    include_once 'db/includes/header.php';
?>
<title>Hjem - Nivelo</title>
</head>

<body style="background-image: url('/assets/img.png'); background-repeat: no-repeat;background-attachment: fixed; background-size: cover;"> 

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
            echo "<h1 class='drop-in pad' style='text-align: left;align-items: left'>Kommuniker med Nivelo, en digital chatportal</h1>";
            echo "<p class='drop-in-2 pad-xl' style='margin-top:35px;text-align:left;color: var(--modaltext);font-weight:300;width:70%;line-height:1.4;'>Udvid talen med Nivelo. Hos os kan du frit kommunikere med dine udlånte selvstændige. Vi tilbyder en enkel og effektiv måde for brugere at kommunikere, dele feedback og holde sig organiseret i løbet af deres projekter.</p>";
            echo "<a href='/chat_room.php'><button class='startclr drop-in-3' style='margin-top: 75px;'>Kom i gang</button></a>";
        }
        else{
            echo "<h1 class='drop-in pad' style='text-align: left;align-items: left'>Kommuniker med Nivelo, en digital chatportal</h1>";
            echo "<p class='drop-in-2 pad-xl' style='margin-top:35px;text-align:left;color: #7a7a7a;font-weight:200;width:70%;line-height:1.4;'>Udvid talen med Nivelo. Hos os kan du frit kommunikere med dine udlånte selvstændige. Vi tilbyder en enkel og effektiv måde for brugere at kommunikere, dele feedback og holde sig organiseret i løbet af deres projekter.</p>";
            echo "<a href='/signup.php' data-modal-target='#modal'><button class='startclr drop-in-3' style='margin-top: 75px;'>Kom i gang</button></a>";

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
                    <div class='title'>Vi bruger cookies 🍪</div>
                    <i class='bi bi-x close-button' data-accept-button></i>

                </div>
                <div class='modal-body'>

                <div class='text'>På vores hjemmeside anvender vi cookies for at sikre den bedst mulige brugeroplevelse og for at forstå, hvordan vores besøgende bruger vores tjenester. Cookies er små tekstfiler, der placeres på din enhed, når du besøger vores hjemmeside. Vi bruger cookies til at huske dine præferencer og til at levere målrettede annoncer baseret på dine interesser.
                </div><div class='text'><br<br> Ved at fortsætte med at bruge vores hjemmeside, accepterer du vores brug af cookies. Hvis du ønsker at ændre dine cookie-indstillinger eller slette eksisterende cookies, kan du gøre dette i din browsers indstillinger. Vær opmærksom på, at blokering eller deaktivering af cookies kan påvirke funktionaliteten og brugeroplevelsen på vores hjemmeside.</div>
                

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