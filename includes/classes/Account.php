<?php
    class Account {
        private $con;
        private $errorArray = array();
        
        public function __constructor($con) {
            $this->con = $con;
        }

        public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateUsername($un);
        }
        
        // fn for firstname
        private function validateFirstName($fn) {
            if(strlen($fn) < 2 || strlen($fn) > 25) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
            }
        }

        private function validateLastName($ln) {
            if(strlen($ln) < 2 || strlen($ln) > 25) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
            }
        }

        private function validateUsername($un) {
            if(strlen($un) < 2 || strlen($un) > 25) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }
            
            // Checking if a username already exists in the database
            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
            
            // in bindParam, you must pass a variable
            // passes the reference to the value/variable
            // $query->bindParam(":un", $un);

            // in bindValue, you can pass either variable, or a string.
            // passes the value itself, and not its reference
            $query->bindValue(":un", $un);

            $query->execute();

            if($query->rowCount() != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
            }
        }

        public function getError($error) { 
            if(in_array($error, $this->errorArray)) {
                return $error;
            }
        }
    }
?>