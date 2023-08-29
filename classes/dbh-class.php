<!-- This file connects our data to and from the database -->
<?php
Class DBH {
    protected function connect() {
        try {
            $dbUsername = "root";
            $dbPassword = "";
            $dbh = new PDO('mysql:host=localhost;dbname:patient_appointments', $dbUsername, $dbPassword);
            return $dbh;
        }

        catch (PDOException $e) {
            print "Connection failed: " . $e -> getMessage() . "<br/>";
            die();
        }
    }
}