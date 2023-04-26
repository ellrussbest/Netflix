<?php
    class FormSanitizer {
        
        // static functions:: you don't have to create an instance of a class in order to call it
        public static function sanitizeFormString($inputText) {
        
            // removes any html tags within the input
            $inputText = strip_tags($inputText);

            // removes all whitespaces (including those that are in the middle) from the name
            // $inputText = str_replace(" ", "", $inputText);

            // removes only the whitespaces from the beginning and the end of the name
            $inputText = trim($inputText);

            // lowercases everything in the string
            $inputText = strtolower($inputText);

            // uppercases the first character
            $inputText = ucfirst($inputText);

            return $inputText;
        }


        public static function sanitizeFormUsername($inputText) {
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);
            return $inputText;
        }

        public static function sanitizeFormPassword($inputText) {
            $inputText = strip_tags($inputText);
            return $inputText;
        }

        public static function sanitizeFormEmail($inputText) {
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);
            return $inputText;
        }
    }
?>