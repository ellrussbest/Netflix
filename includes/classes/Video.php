<?php
    class Video {
        private $con, $sqlData, $entity;
            
        public function __construct($con, $entity) {
            $this->con = $con;
            
            // if entity is passed explicitly as an object
            if(is_array($entity)) {
                $this->sqlData = $entity;
            }else if(is_string($entity)) { // entity passed as an ID
                $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
                $query->bindValue(":id", $entity, PDO::PARAM_INT);
                $query->execute();
                $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            }else { // else just assign any random entity
                $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 1");
                $query->execute();
                // Fetch the data and store it in an associative array
                $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            }

            $this->entity = new Entity($con, $this->sqlData["entityId"]);
        }

        public function getId() {
            return $this->sqlData["id"];
        }

        public function getTitle() {
            return $this->sqlData["title"];
        }

        public function getDescription() {
            return $this->sqlData["description"];
        }

        public function getFilepath() {
            return $this->sqlData["filePath"];
        }

        public function getThumbnail() {
            return $this->entity->getThumbnail();
        }

        public function getEpisodeNumber() {
            return $this->sqlData["episode"];
        }

        public function getSeasonNumber() {
            return $this->sqlData["season"];
        }

        public function getEntityId() {
            return $this->sqlData["entityId"];
        }

        public function getSeasonAndEpisode() {
            if($this->isMovie()) return;
            
            $season = $this->getSeasonNumber();
            $episode = $this->getEpisodeNumber();

            return "Season $season, Episode $episode";
        }

        public function isMovie() {
            return $this->sqlData["isMovie"] == 1;
        }

        public function incrementViews() {
            $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
            $query->bindValue(":id", $this->getId());
            $query->execute();
        }

        public function isInProgress($username) {
            $query = $this->con->prepare("SELECT * FROM videoProgress
                                                WHERE videoId=:videoId AND username=:username 
                                                ");
            $query->bindValue(":videoId", $this->getId());
            $query->bindValue(":username", $username);
            $query->execute();

            return $query->rowCount() != 0;
        }

        public function hasSeen($username) {
            $query = $this->con->prepare("SELECT * FROM videoProgress
                                                WHERE videoId=:videoId AND username=:username 
                                                AND finished=1");
            $query->bindValue(":videoId", $this->getId());
            $query->bindValue(":username", $username);
            $query->execute();

            return $query->rowCount() != 0;
        }

    }

?>