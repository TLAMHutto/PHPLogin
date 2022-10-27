<?php
 class Account {
    private $errorArray;
        public function __construct() {
            $this->$errorArray = array();
        }
        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);
            if ($this->validateUsername($un) && $this->validateFirstName($fn) && $this->validateLastName($ln) && $this->validateEmails($em, $em2) && $this->validatePasswords($pw, $pw2)) {
                // Insert into database
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }
            return false;
        }
        // private function insertUserDetails($un, $fn, $ln, $em, $pw) {
        //     $encryptedPw = md5($pw);
        //     $profilePic = "assets/images/profile-pics/head_emerald.png";
        //     $date = date("Y-m-d");
        //     $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
        //     return $result;
        // }
        private function validateUsername($un) {
            if (strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, "Your username must be between 5 and 25 characters");
                return false;
            }
        private function validateFirstName($fn) {
            if (strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, "Your first name must be between 2 and 25 characters");
                return false;
            }
        }
        private function validateLastName($ln) {
            if (strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, "Your last name must be between 2 and 25 characters");
                return false;
            }
        }
        private function validateEmails($em, $em2) {
            if ($em != $em2) {
                array_push($this->errorArray, "Your emails don't match");
                return false;
            }
            if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, "Email is invalid");
                return false;
            }
            // Check that username hasn't already been used
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if (mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, "Email is already in use");
                return false;
            }
        }
        private function validatePasswords($pw, $pw2) {
            if ($pw != $pw2) {
                array_push($this->errorArray, "Your passwords don't match");
                return false;
            }
            if (preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, "Your password can only contain numbers and letters");
                return false;
            }
            if (strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->errorArray, "Your password must be between 5 and 30 characters");
                return false;
            }
        }

 }

 
?>