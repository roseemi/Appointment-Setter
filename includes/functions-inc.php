<?php
/*
 * A page of all functions used in other files of the project
 */
// Return whether any of the fields in the signup form are empty
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat): bool {
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
// Return if the username is invalid (valid = containing ONLY alphabetical and digit characters
function invalidUid($username): bool {
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Return if the email is invalid, using the built-in php filter
function invalidEmail($email): bool {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Return if the 2 inputted passwords match
function pwdMatch($pwd, $pwdRepeat): bool {
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Connect to the database
// Check to see if that username or email already exists in the database
function uidExists($conn, $username, $email) {
    // Prepared statement to send to the server
    $sql = "SELECT * FROM users WHERE user_uid = ? OR user_email = ?;";
    // Send the statement to our database
    $stmt = mysqli_stmt_init($conn);

    /* Will this fail? If yes, exit and return the user to the signup page.
    If not, continue. */
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // Bind data from user to our statement
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    // Send data to the server
    mysqli_stmt_execute($stmt);

    // Store the response from the server
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; /* Return all data from the database row */
    }
    else {
        $result = false;
        return $result;
    }

    // End/close our statement
    mysqli_stmt_close($stmt);
}

/* Instead of checking for a user, now we will INSERT into the database,
   now that we know that the user is unique. */
function createUser($conn, $name, $email, $username, $pwd) {
    // Create our prepared statement
    $sql = "INSERT INTO users (user_name, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    /* We need to make mysqli_stmt_bind_param parameters more difficult to understand by using hashing
    This will make everything random strings and become unreadable */

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

// Check if any login fields are empty
function emptyInputLogin($username, $pwd): bool {
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Log the user into the system
function loginUser($conn, $username, $pwd) {
    /* User can pass username or email, both stored under "$username", so put $username twice to check for one or the other */
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=invalidlogin");
        exit();
    }

    $hashedPwd = $uidExists["user_pwd"];
    $checkPwd = password_verify($pwd, $hashedPwd);

    if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["useruid"] = $uidExists["user_uid"];
        header("location: ../index.php");
    }
    else {
        header("location: ../login.php?error=wronglogin");
    }
}