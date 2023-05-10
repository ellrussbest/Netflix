<?php 
    require_once("./includes/config.php");
    require_once("./includes/classes/PreviewProvider.php");
    require_once("./includes/classes/CategoryContainer.php");
    require_once("./includes/classes/EntityProvider.php");
    require_once("./includes/classes/ErrorMessage.php");
    require_once("./includes/classes/SeasonProvider.php");
    require_once("./includes/classes/Entity.php");
    require_once("./includes/classes/Video.php");
    require_once("./includes/classes/Season.php");
    
    $userLoggedIn = $_SESSION["userLoggedIn"];
    
    if(!isset($_SESSION["userLoggedIn"])) {
       header("Location: register.php"); 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Bestflix</title>
    <link rel="stylesheet" type="text/css" href="./assets/style/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/575cb89052.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"> </script>

</head>

<body>
    <div class='wrapper'>