<?php

session_start();
session_unset();
session_destroy();

setcookie("user", "", time() - 3600, "/");
setcookie("login_token", "", time() - 3600, "/");


header("location: ../../");
exit();