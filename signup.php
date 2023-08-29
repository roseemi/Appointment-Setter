<?php
    include_once 'header.php';
?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <!-- Action = where you are redirected in order to pass your info -->
    <!-- -inc "include", it will not be a page you see, only a page to pass information -->
    <form action="./includes/signup-inc.php" method="post">
        <label for="name">Name:</label>
        <input id="name" type="text" name="name" placeholder="Your name...">

        <label for="email">Email:</label>
        <input id="email" type="email" name="email" placeholder="Your email...">

        <label for="uid">Username:</label>
        <input id="uid" type="text" name="uid" placeholder="Username...">

        <label for="pwd">Password:</label>
        <input id="pwd" type="password" name="pwd" placeholder="Password...">

        <label for="pwdrepeat">Verify password:</label>
        <input id="pwdrepeat" type="password" name="pwdrepeat" placeholder="Repeat password...">

        <button type="submit" name="submit">Sign Up!</button>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Please fill in all fields.</p>";
            }
            elseif ($_GET["error"] == "invaliduid") {
                echo "<p>Please choose a valid username.</p>";
            }
            elseif ($_GET["error"] == "invalidemail") {
                echo "<p>Please choose a valid email.</p>";
            }
            elseif ($_GET["error"] == "passwordmismatch") {
                echo "<p>Passwords do not match.</p>";
            }
            elseif ($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong! Try again.</p>";
            }
            elseif ($_GET["error"] == "usernametaken") {
                echo "<p>That username is taken.</p>";
            }
            elseif ($_GET["error"] == "none") {
                echo "<p>You have signed up!</p>";
            }
        }
        ?>
    </form>
</section>

<?php
    include_once 'footer.php';
?>