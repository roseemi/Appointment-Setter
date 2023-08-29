<?php
    include_once 'header.php';
?>

    <section class="signup-form">
        <h2>Login</h2>
        <!-- Action = where you are redirected in order to pass your info -->
        <!-- -inc "include", it will not be a page you see, only a page to pass information -->
        <form action="./includes/login-inc.php" method="post">
            <label for="uid">Username or email:</label>
            <input id="uid" type="text" name="uid" placeholder="Username/Email...">

            <label for="pwd">Password:</label>
            <input id="pwd" type="password" name="pwd" placeholder="Password...">

            <button type="submit" name="submit">Login</button>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Please fill in all fields.</p>";
                }
                elseif ($_GET["error"] == "wronglogin") {
                    echo "<p>Incorrect username, email, or password.</p>";
                }
            }
            ?>
        </form>
    </section>

<?php
include_once 'footer.php';
?>