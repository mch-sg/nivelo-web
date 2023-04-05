
<header id="header" class="head">
    <a class="h-logo pro" href="/" style="font-size: 18px; transition: 0.2s;">
        <!-- <img src="https://res.cloudinary.com/coolors/image/upload/t_60x60/v1636729140/live/custom-avatars/fzhn1oqool8tpb2am7hx.jpg"></img> -->
        <div class="hv">
            <img style="vertical-align: middle;margin-left: 15px;" src="/assets/nivelo-2.svg" width="100px"></img>
        </div>
    <!-- Webportal -->
    </a>

    
    <nav>
        <ul class="nav_links">
            <!-- <li>
                <div class="divclr">
                    <a id="p1" class="diva" href="#">Projects</a>
                    <a id="p2" class="divb bi bi-chevron-down"></a>
                </div>
            </li> -->
            
            <!-- <li><a class="pro" href="/invite.php">Inviter</a></li>
            <li><a class="pro" href="/sidebar-prototype.php">Chat</a></li> -->

            <?php
                if(isset($_SESSION["useruid"])){
                    echo "<a href='javascript:void(0);' onclick='myFunction()' id='p2' class='icon divb bi bi-chevron-down'> </a></li>";
                    
                    echo "<div class='disc' id='navlink' style='z-index: 1000;'>";
                    echo "<li><a class='pro nlink' style='vertical-align: middle;' href='invite.php'>Opret nyt rum</a></li>";
                    echo "<li><a class='pro nlink' style='vertical-align: middle;' href='/chat_room.php'>Chatrum</a></li>";
                    echo "<li id='brd2' class='brd' style='vertical-align: middle;text-align: center;border-left: 1px solid var(--borderclr); height: 35px; margin: 0 0 0 20px;'></li>";
                    echo "<li><a class='pro nlink' style='vertical-align: middle;' href='profile.php'>Profil</a> </div>";

                    // echo "<li><a class='modal-btn-header' href='/db/includes/logout.inc.php' style='vertical-align: middle;'>Log ud</a></li>";
                    // echo "<li><a class='pro' href='db/includes/logout.inc.php'>Log ud</a></li>";
                }
                else {
                    echo "<a href='javascript:void(0);' onclick='myFunction()' id='p2' class='icon divb bi bi-chevron-down'> </a></li>";

                    echo "<div class='disc' id='navlink' style='z-index: 1000;'>";
                    echo "<li><a class='pro nlink' style='vertical-align: middle;' href='/about.php'>Opdag</a></li>";
                    echo "<li><a class='pro nlink' style='vertical-align: middle;' href='/chat_room.php'>Chatrum</a></li>";
                    // echo "<li><a class='pro' style='vertical-align: middle;' href='/pro.php'>Gå Pro</a></li>";
                    echo "<li id='brd2' class='brd' style='vertical-align: middle;text-align: center;border-left: 1px solid var(--borderclr); height: 35px; margin: 0 0 0 20px;'></li>";
                    echo "<li><a class='pro nlink' style='vertical-align: middle;' href='login.php'>Log på</a></li>";
                    echo "<li><a class='modal-btn-header nlink' href='signup.php' style='vertical-align: middle;'>Tilmeld</a></li> </div>";
                    
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