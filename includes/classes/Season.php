<?php 
    class Season {
        private $seasonNumber, $videos;
        
        // videos array of video objects
        public function __construct($seasonNumber, $videos) {
            $this->seasonNumber = $seasonNumber;
            $this->videos = $videos;
        }

        public function getSeasonNumber() {
            return $this->seasonNumber;
        }

        public function getVideos() {
            return $this->videos;
        }
    }
?>