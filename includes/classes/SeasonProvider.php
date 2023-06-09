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

           if(sizeof($seasons) == 0) return;
           
           $seasonHtml = "";
           
           foreach($seasons as $season) {
            $seasonNumber =  $season->getSeasonNumber();

            $videosHtml = "";

            foreach($season->getVideos() as $video) {
                $videosHtml .= $this->createVideoSquare($video);
            }
            
            $seasonHtml .= "<div class='season'> 
                <h3> Season $seasonNumber </h3>
                <div class='videos'>
                    $videosHtml
                </div>
            </div>";
           }

           return $seasonHtml;
        }

        private function createVideoSquare($video) {
            $id = $video->getId();
            $thumbnail = $video->getThumbnail();
            $title = $video->getTitle();
            $description = $video->getDescription();
            $episodeNumber = $video->getEpisodeNumber();
            $hasSeen = $video->hasSeen($this->username) ? "<i class='fa-solid fa-circle-check seen'></i>" : "";
            
            
            $filepath = $video->getFilepath();

            return "<a href='watch.php?id=$id'> 
                <div class='episodeContainer'>
                    <div class='contents'>
                        <img src='$thumbnail' />

                        <div class='videoInfo'>
                            <h4>$episodeNumber. $title</h4>
                            <span>$description</span>
                        </div>
                        $hasSeen
                    </div>
                </div>
            </a>";
        }
    }
?>