<?php 
    class SeasonProvider {
        private $con;
        private $username;
        
        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
        }

        public function create($entity) {
           $seasons = $entity->getSeasons($entity);
        }
    }
?>