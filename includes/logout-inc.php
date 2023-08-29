<?php
    // Reset all the session data
    session_start();
    session_unset();
    session_destroy();
    header("location: ../index.php");
