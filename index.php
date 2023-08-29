<?php
    include_once 'header.php';
?>
<section class="one">
    <?php
    if (isset($_SESSION["useruid"])) {
        echo '<p id="welcome">Hello ' . $_SESSION["userid"] . "!</p>";
        echo '<p>Please fill the form below to begin booking your appointment.</p>';
        echo '<p>*This is a fictional registration form.</p>';
    }
    else {
        echo '<p>Please log in to continue.</p>';
    }
    ?>
</section>
<section class="two">
    <?php
    if (isset($_SESSION["useruid"])) {
        echo "<h1>Register for an appointment</h1>";
        echo '<form action="#" method="post" id="appt">';

        echo '<label for="reason">Reason for appointment:</label>';
        echo '<select>';
        echo '<option value="checkup">Check up</option>';
        echo '<option value="referral">Referral</option>';
        echo '<option value="mentalhealth">Mental Health</option>';
        echo '<option value="consultation">Consultation</option>';
        echo '<option value="other">Other</option>';
        echo '</select>';

        echo '<label for="detail">Explain the reason for your appointment in more detail:</label>';
        echo '<textarea id="detail" form="appt" name="detail" placeholder="Type here..."></textarea>';

        echo '<label for="date">Please pick a time for your appointment:</label>';
        echo '<input id="date" type="datetime-local" name="date">';

        echo '<input type="submit" value="Submit">';
        echo '</form>';
    }
    ?>
</section>
<?php
    include_once 'footer.php'
?>