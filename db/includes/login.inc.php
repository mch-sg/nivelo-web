<?php
     session_start();
?>

<?php

if(isset($_POST['submit'])){

     session_start();

    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once '../includes/dbh.inc.php';
    require_once '../includes/functions.inc.php';

    if(emptyInputLogin($username, $pwd) !== false){
        header("location: ../../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);

}
else{
    header("location: ../attributes/login.php");
    exit();
}