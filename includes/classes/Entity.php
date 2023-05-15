<?php
    	class Entity {
            private $con, $sqlData;
            
            public function __construct($con, $entity) {
                $this->con = $con;

                // if entity is passed explicitly
                if(is_array($entity)) {
                    $this->sqlData = $entity;
                }else if(is_string($entity)) {
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

            public function getThumbnail() {
                return $this->sqlData["thumbnail"];
            }

            public function getPreview() {
                return $this->sqlData["preview"];
            }

            public function getCategoryId() {
                return $this->sqlData["categoryId"];
            }

            public function getSeasons() {
                $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id
                                        AND isMovie=0 ORDER BY season, episode ASC");
                
                $query->bindValue(":id", $this->getId());
                $query->execute();
                
                $seasons = array();
                $videos = array();
                $currentSeason = null;

                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    
                    // the currentSeason will not be changed after every iteration
                    // this way it can always be initialized
                    // but when we continue looping over our data, the season row of our data is bound to change
                    // so when if this changes it will not match with the current array and maybe we can take action
                    // the action would be to push all our video objects that we created to the current season the update the current season
                    if($currentSeason != null && $currentSeason != $row["season"]) {
                        $seasons[] = new Season($currentSeason, $videos);
                        $videos = array();
                    }
                    $currentSeason = $row["season"];

                    // we will continue pushing new video objects until the currentSeason variable is not
                    // equal to row['season']
                    $videos[] = new Video($this->con, $row); 
                }
                if(sizeof($videos) != 0) $seasons[] = new Season($currentSeason, $videos);

                return $seasons;
            }
        }
?>