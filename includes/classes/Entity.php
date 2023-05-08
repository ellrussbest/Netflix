<?php
    	class Entity {
            private $con, $sqlData;
            
            public function __construct($con, $entity) {
                $this->con = $con;

                // if entity is passed explicitly
                if($entity) {
                    $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
                    $query->bindValue(":id", $entity, PDO::PARAM_INT);
                    $query->execute();
                    $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
                }else { // else just assign any random entity
                    $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
                    $query->execute();
                    // Fetch the data and store it in an associative array
                    $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
                }
            }

            public function getId() {
                return $this->sqlData["id"];
            }

            public function getName() {
                return $this->sqlData["name"];
            }

            public function getTumbnail() {
                return $this->sqlData["thumbnail"];
            }

            public function getPreview() {
                return $this->sqlData["preview"];
            }

            public function getSeasons($entity) {
                $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id
                                        AND isMovie=0 ORDER BY season, episode ASC");
                
                $query->bindValue(":id", $entity->getId());
                $query->execute();
                
                $season = array();
                $videos = array();
                $currentSeason = null;

                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $currentSeason = $row["season"];
                    $videos[] = new Video($this->con, $row);
                }
            }
        }
?>