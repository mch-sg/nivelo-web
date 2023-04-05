<?php

if(isset($_POST['reset-password-submit'])) {

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];

    $password = $_POST['pwd-n'];
    $passwordRepeat = $_POST['pwd-repeat-n'];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../../signup.php?newpwd=empty");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../../create-new-password.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(!$row = mysqli_fetch_assoc()) {
            echo "You need to re-submit your reset request.";
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
            
            if($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } else if ($tokenCheck === true) {
                
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE emailUsers = ?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(!$row = mysqli_fetch_assoc()) {
                        echo "There was an error!";
                        exit();
                    } else {

                        $sql = "UPDATE users SET pwdUsers = ? WHERE emailUsers = ?;";

                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?;";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../../login.php?newpwd=passwordupdated");
                            }
                        }


                    }
                }

            }
            
        }
    }


    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailTo = "";
    $emailFrom = "";
    $headers = "From: ".$emailFrom;
    $txt = "You have received an e-mail from ".$name.".\n\n".$message;
    
    mail($mailTo, $subject, $txt, $headers);
    header("Location: index.php?mailsend");

} else {
    header("Location: ../../index.php");
}

?>