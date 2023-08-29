<?php

Class ProfileCtrl extends ProfileInfo {

    private $userId;
    private $userUid;
    private $email;

    public function __construct($userId, $userUid) {
        $this -> userId = $userId;
        $this -> userUid = $userUid;
    }

    public function defaultProfileAppointments() {
        $profileId = $this -> userId;
        $profileEmail = $this -> email;
        $this -> setProfileInfo($profileId, $profileEmail);
    }

    public function updateProfile($email) {
        // Check for errors
        if (emptyInputCheck()) {
            header("location: profilesettings.php?error=emptyinput");
            exit();
        }
        // Update info if there are no errors
        else {
            $this -> setProfileInfo($this -> userId, $email);
        }
    }

    private function emptyInputCheck($email) {
        $result;
        if (empty($email)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
}