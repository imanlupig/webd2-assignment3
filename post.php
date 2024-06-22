<?php

/*******w******** 
    
    Name: Ian Manlupig
    Date: 2024-06-17
    Description: Module 3 CRUD Assignment POST PAGE

****************/

require('connect.php');
require('authenticate.php');

if($_POST && !empty($_POST['title']) && !empty($_POST['content'])) {
    //sanitize input 
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $title = trim($title);
    $content = trim($content);

    //make sql query 
    $query = "INSERT INTO blog (title, content) VALUES (:title, :content)";
    $statement = $db->prepare($query);

    //bind values to parameters
    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);

    //execute the insert execute() will check for possible SQL injection and remove if necessary
    if($statement->execute()){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Blog Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
     <div id="wrapper">
        <div id="header">
                <h1><a href="index.php">New Post</a></h1>
            </div> 

            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="post.php" class="active">New Post</a></li>
            </ul>

        <form method="post" action="post.php">
            <fieldset>
                <legend>Blog Post</legend>
                <label for="title">Title</label>
                <input name="title" id="title">
                <label for="content">Content</label>
                <textarea name="content" id="content"></textarea>
                <br>
                <input type="submit" value="Create">
            </fieldset>
        </form>
    </div>
</body>
</html>