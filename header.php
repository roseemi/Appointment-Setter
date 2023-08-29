<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Register for an appointment.">
    <title>Appointment Registration</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <script src="https://kit.fontawesome.com/026849d5bd.js" crossorigin="anonymous"></script>
</head>
<header>
    <a href="./header.php"><i class="fa-solid fa-stethoscope"></i></a>
    <?php
    if (isset($_SESSION["useruid"])) {
        echo '<a href="./profile.php">Profile</a>';
        echo '<a href="./includes/logout-inc.php">Logout</a>';
    }
    else {
        echo '<a href="signup.php">Sign up</a>';
        echo '<a href="./includes/login-inc.php">Login</a>';
    }
    ?>
</header>
<main>
<body>
