<?php
    class Video {
        private $con, $sqlData, $entity;
            
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

            $this->entity = new Entity($con, $this->sqlData["entityId"]);
        }

    }

?>