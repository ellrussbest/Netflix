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

# Entity page
- On the entity page, we will also show a preview of the video
- below the preview, we want to show different seasons and every episode of each season
- remember we have the entity id, and we will use the entity id to query all the videos with that specific entity id
- this means we have to use the entity object through the entity id to get all the seasons for a given entity
- The data that comes to the front end looks a little bit like the folloing
```
    {
            name: "Michael Jackson Is the Best",
            season: 1,
            episode: 1
        },
        {
            name: "Michael Jackson Is the Best",
            season: 1,
            episode: 2
        },
        {
            name: "Michael Jackson Is the Best",
            season: 1,
            episode: 3
        },
        {
            name: "Michael Jackson Is the Best",
            season: 2,
            episode: 1
        },
        {
            name: "Michael Jackson Is the Best",
            season: 2,
            episode: 2
        },
        {
            name: "Michael Jackson Is the Best",
            season: 2,
            episode: 3
    }
```
- The thing that we want to do is to create a videos array that will store all the video objects.
- Then we will create a seasons array that will store all the seasons objects.
- so the season array in our case will hold 2 season objects and each season object will have an array of video objects (That's the idea!)
- In our while loop when we hit the next season, we will first push all the videos on the array to the the season array

- at the bottom of the entity page, you'll see that "you might also suggestions"
- to achieve this, on the entity.php page, we already have the Entity that we are watching
- To make suggestions, we are going to pull all thumbnails of movies and videos etc. of the catgories with the same entity Id  