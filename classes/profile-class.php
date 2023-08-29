<?php

Class ProfileInfo extends DBH {

    protected function getProfileInfo($userId) {
        $stmt = $this -> connect() -> prepare('SELECT * FROM profiles WHERE user_id = ?;');

        /* Pass the prepared statement into an array, replacing the ? with the user_id from the DB*/
        if ($stmt -> execute(array($userId))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        /* If we didn't get any data from the database */
        if ($stmt -> rowCount() == 0) {
            $stmt = null;
            header('location: profile.php?error=profilenotfound');
            exit();
        }

        /* Fetch data from the DB as an associative array, based on the column names of the DB */
        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;
    }

    protected function setNewProfileInfo($userId, $email) {
        $stmt = $this -> connect() -> prepare
            ('UPDATE profiles SET profile_email = ? WHERE user_id = ?;');

        /* Pass the prepared statement into an array, replacing the ? with the user_id from the DB*/
        if ($stmt -> execute(array($userId, $email))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        /* Reset the stmt after each execution */
        $stmt = null;
    }

    protected function setProfileInfo($userId, $email) {
        $stmt = $this -> connect() -> prepare
            ('INSERT INTO profiles (user_id, profile_email) VALUES (?, ?);');

        /* Pass the prepared statement into an array, replacing the ? with the user_id from the DB*/
        if ($stmt -> execute(array($userId, $email))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        /* Reset the stmt after each execution */
        $stmt = null;
    }
}