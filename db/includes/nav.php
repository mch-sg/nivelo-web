<header id="header" class="head" style="height:85px">
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

            // echo "<li>
            // <a class='pro nlink' style='vertical-align: middle;' href='https://nivelo.eu/profile'>
            // <i class='fa-solid fa-gear' style='vertical-align: revert;font-size: 17px;'></i> </a>
            // </li>";
            // echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://nivelo.eu/profile'>{$_SESSION["useruid"]}</a> ";

            // echo "<li><a class='modal-btn-header nlink' href='logout.inc.php' style='vertical-align: middle;padding: 1rem 1.5rem;'>Log ud</a></li> </div></div>";

        }
        else {
            echo "<a href='javascript:void(0);' onclick='myFunction()' id='p2' class='icon divb bi bi-chevron-down'> </a></li>";

            echo "<div class='disc' id='navlink' style='z-index: 1000;'>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='/about'>About</a></li>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://chat.nivelo.eu'>Chatrooms</a></li>";
            // echo "<li><a class='pro' style='vertical-align: middle;' href='//pro'>Gå Pro</a></li>";
            echo "<li id='brd2' class='brd' style='vertical-align: middle;text-align: center;border-left: 1px solid var(--borderclr); height: 35px; margin: 0 0 0 20px;'></li>";
            echo "<li><a class='pro nlink' style='vertical-align: middle;' href='https://nivelo.eu/login'>Sign in</a></li>";
            echo "<li><a class='modal-btn-header nlink' href='https://nivelo.eu/signup' style='vertical-align: middle;padding: 0.85rem 1.25rem;'>Sign up</a></li> </div>";
            
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