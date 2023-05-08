## Explanation of the database structure

- On the top level we have Videos.
- A video has an Id, title, description, filepath, isMovie, uploadDate, releaseDate, views, duration, season, episode and entityId
- Each video will fall under a given entity. Every video under one Entity will share a video preview, category, thumbnail and Entity name
# Index page
- So the Idea is that when someone loads the page, any video preview will be picked. This will obviously be done by Entities because only the entities have the preview videos
- After the preview has finished playing, the png/thumbnail of the entity will be displayed
- below the preview video, different categories, and their thumbnail will be displayed.
- again you have to remember that only videos that are under the same entity will have the same thumbnail
- so this is the logic used to display categories and the thumbnail for each video
- the first thing is that we are going to get all the categories from the database and store them in an associative array
- we will then loop through the associative array as we display all the entities under a given category e.g.
```
    for (category of categories) {
        for (entity[category]){
            // display Entity thumbnail as anchor tags
            // which when clicked takes you to a specific Entity Id
        }
    }
```
- On the entity page, we will also show a preview of the video
- below the preview, we want to show different seasons and every episode of each season
- remember we have the entity id, and we will use the entity id to query all the videos with that specific entity id
- The idea here is that each season will have an array for their videos.