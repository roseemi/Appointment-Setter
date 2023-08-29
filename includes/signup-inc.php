<?php
    /* Check if user got here properly by filling out the form, instead of forced via the URL */
    if (isset($_POST["submit"])) { /* If the user submitted the form */
        /* Retrieve all the info the user passed into the form */
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];

        require_once 'dbh-inc.php';
        require_once 'functions-inc.php';

        /* If it is ANYTHING except for "false". This is different from "is it true or false" */
        if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
            header("location: ../signup.php?error=emptyinput"); /* We will parse the error inside the URL to see the issue */
            exit();
        }
        if (invalidUid($username) !== false) {
            header("location: ../signup.php?error=invaliduid"); /* We will parse the error inside the URL to see the issue */
            exit();
        }
        if (invalidEmail($email) !== false) {
            header("location: ../signup.php?error=invalidemail"); /* We will parse the error inside the URL to see the issue */
            exit();
        }
        if (pwdMatch($pwd, $pwdRepeat) !== false) {
            header("location: ../signup.php?error=passwordmismatch"); /* We will parse the error inside the URL to see the issue */
            exit();
        }
        if (uidExists($conn, $username, $email) !== false) {
            header("location: ../signup.php?error=usernametaken"); /* We will parse the error inside the URL to see the issue */
            exit();
        }

        createUser($conn, $name, $email, $username, $pwd);
    }
    else {
        header("location: ../signup.php");
        exit();
    }