## Explanation of the database structure
## For us to best understand the how we can filter data from our databases it's best we understand the set theory [SET THEORY](https://math24.net/set-operations-venn-diagrams.html)

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

- we create a videoProgress table that will keep the progress of the user as they watch a particular video

## displaying the current movie and episode that the user is watching
- we have to select video from the progress from video and from that video we want to get it's entity.
- so we have to backtrack using the video id and get it's entitity and from the list of the enitites that are listed we are 
- supposed to get the video with the latest modification. i.e. a video that was interacted with soonest enough e.g.

```
SELECT videoId FROM `videoProgress` INNER JOIN videos
ON videoprogress.videoId = videos.id
WHERE vides.entityId = 82
AND videoProgress.username = 'reece-kenney'
ORDER BY videoProgress.dateModified DESC
LIMIT 1
```

```
    1. <b>AND</b> operator: The <b>intersection</b> of the circles representing A and B, denoted by A ∧ B. Also known as <b>conjunction</b>.

    2. <b>OR</b> operator: The <b>union</b> of the circles representing A and B, denoted by A ∨ B. Also known as <b>disjunction</b>.

    3. <b>NOT</b> operator: The <b>complement</b> of the circle representing A, denoted by ¬A. Also known as negation.

    4. <b>XOR</b> operator: The shaded area that is inside A but outside B, or vice versa, denoted by A ⊕ B. Also known as <b>exclusive disjunction</b>.

    5. <b>NAND</b> operator: The complement of the intersection of the circles representing A and B, denoted by ¬(A ∧ B). Also known as not <b>conjunction</b>.

    6. <b>NOR</b> operator: The complement of the union of the circles representing A and B, denoted by ¬(A ∨ B). Also known as <b>not disjunction</b>.

    7. <b>XNOR</b> operator: The shaded area that is inside both A and B, or outside both A and B, denoted by A ≡ B. Also known as <b>equivalence</b>.

    Note that the Venn diagrams for the XOR and XNOR operators are a bit more complex than the others, since they involve shading areas that are inside one circle but outside the other.
```

## SEARCH
- we want to perfom the search everytime a user keys in an input and pauses after 5ms
- we don't want to create a request each and every time there's  a change because this could
- create a lot of requests.
- so the best solution is any time a user keys in a input and pauses for five seconds, then we make a request.
- this can be achieved by setTimeout()

## paypal integration
- you first need to download the paypal php sdk
- after extracting the compressed folder, you can add it to the root of you project
- you can then go ahead to and create a pyapal config file where you can add all the paypal configurations through this file
- then go to developer.paypal.com
- create an app where you'll be given an app account, secret and a client ID
- you can now google the paypal developer api and 
- we are then required to create a paypal billing plan (names, descriptions, how often the transaction should happen, price etc.)
- after creating a billing plan we can then create a billing agreement
- billing agreement will be used to make a transaction based on the billing agreement.
- when a user cancels their subscription, we can keep tab of that using the paypal webhook
