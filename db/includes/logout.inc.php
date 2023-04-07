<?php


 session_start();
session_unset();
session_destroy();

setcookie("user", "", time() - 3600, "/", ".nivelo.eu");
setcookie("login_token", "", time() - 3600, "/", ".nivelo.eu");
setcookie('loggedin', "false", time() + (86400 * 30), "/", ".nivelo.eu"); // 30 days


header("location: ../../");
exit();