<?php
    class PreviewProvider {
        private $con;
        private $username;
        
        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
        }

        public function createPreviewVideo($entity) {
            $entity = new Entity($this->con, $entity);

            
            $id = $entity->getId();
            $name = $entity->getName();
            $preview = $entity->getPreview();
            $thumbnail = $entity->getTumbnail();

            return "<div class='previewContainer'>
                <img src='$thumbnail' class='previewImage' hidden/>
                
                <video autoplay muted class='previewVideo'>
                    <source src='$preview' type='video/mp4'>
                </video>
            </div>";
        }
    }
?>