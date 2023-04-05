<?php


session_start();
session_unset();
session_destroy();

setcookie("user", "", time() - 3600, "/");
setcookie("login_token", "", time() - 3600, "/");
setcookie('loggedin', "false", time() + (86400 * 30), "/"); // 30 days


header("location: ../../");
exit();