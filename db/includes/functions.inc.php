<?php

// Funktion til at lave tom tilmeldelse fejl
function emptyInputSignup($name, $email, $username, $pwd) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Funktion til at lave tom userid fejl
function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9.]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Funktion til at lave tom email fejl
function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Funktion til at tjekke om brugernavn/mail eksisterer
function uidExists($conn, $username, $email) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE usersUid = :uuid OR usersEmail = :uemail");

    if (!$stmt) {
        header("location: ../../signup.php?error=stmtfailed");
        exit();
    }

    $stmt->bindParam(':uuid', $username);
    $stmt->bindParam(':uemail', $email);
    $stmt->execute();
    $resultData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row = $resultData) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

}

// Funktion til at oprette bruger
function createUser($conn, $name, $email, $username, $pwd) {
    $stmt = $conn->prepare("INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (:uN, :uE, :uU, :uP);");

    if (!$stmt) {
        header("location: ../../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt->bindParam(':uN', $name);
    $stmt->bindParam(':uE', $email);
    $stmt->bindParam(':uU', $username);
    $stmt->bindParam(':uP', $hashedPwd);
    $stmt->execute();

    loginUser($conn, $username, $pwd);

    header("location: ../../chat_room.php");
    exit();
}

// Funktion til at lave tom login fejl
function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Funktion til at logge en bruger ind
function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../../login.php?error=wronglogin");
        exit();
    }
    
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["username"] = $uidExists["usersName"];
        $_SESSION["useruid"] = $uidExists["usersUid"];

        header("location: ../../");
        exit();
    }
    
}


