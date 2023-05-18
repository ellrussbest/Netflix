<?php
    class PreviewProvider {
        private $con;
        private $username;
        
        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
        }

        public function createPreviewVideo($entity) {
            if(!$entity) $entity = EntityProvider::getEntities($this->con, null, 1)[0];
            
            $id = $entity->getId();
            $name = $entity->getName();
            $preview = $entity->getPreview();
            $thumbnail = $entity->getThumbnail();

            $videoId = VideoProvider::getEntityVideoForUser($this->con, $id, $this->username);

            $video = new Video($this->con, $videoId);

            // checks if the current video is in progress
            $inProgress = $video->isInProgress($this->username);

            $playButton = $inProgress ? "Continue watching" : "Play";
            $seasonEpisode = $video->getSeasonAndEpisode();
            $subHeading = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>";

            return "<div class='previewContainer'>
                <img src='$thumbnail' class='previewImage' hidden/>
                
                <video autoplay muted class='previewVideo' onended='previewEnded()'>
                    <source src='$preview' type='video/mp4'>
                </video>

                <div class='previewOverlay'>
                    <div class='mainDetails'>
                        <h3> $name </h3>
                        $subHeading
                        <div class='buttons'>
                            <button onclick='watchVideo($videoId)'>
                                <i class='fa-solid fa-play'></i>
                                $playButton
                            </button>
                            <button onclick='volumeToggle(this)'>
                                <i class='fa-solid fa-volume-xmark'></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>";
        }

        public function createEntityPreviewSquare($entity) {
            $id = $entity->getId();
            $thumbnail = $entity->getThumbnail();
            $name = $entity->getName();

            return "<a href='entity.php?id=$id'>
                        <div class='previewContainer small'>
                            <img src='$thumbnail' title='$name'>
                        </div>
                    </a>
            ";
        }
    }
?>