<?php

/*******w******** 
    
    Name: Ian Manlupig 
    Date: 2024-06-17
    Description: Module 3 CRUD Assignment EDIT PAGE

****************/

require('connect.php');
require('authenticate.php');

//action variable to check if $_POST[action] is DELETE 
$action = $_POST['action'];
//if statement that will check if the DELETE button is clicked then will delete the data that matches id# from GET paramater
if($action == "Delete"){
    if(isset($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        $query = "DELETE FROM blog WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        if($statement->execute()){
            header("Location: index.php");
        }
    }
//checks title, content and id are not empty, then sanitizes and binds the values to the proper variable
} else if($_POST && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])){
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "UPDATE blog SET title = :title, content = :content WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

//if title and content are empty the page will redirect to an error page
    if(empty($title) || empty($content)){
        header("Location: error.php");
        exit();
    }

//if parameters are valid then it will execute the update and redirect to home page
    if($statement->execute()){
        header("Location: index.php");
        exit;
    }

    } else if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);   

    $query = "SELECT * FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO:: PARAM_INT);

    $statement->execute();
    $row = $statement->fetch();
    } else {
    $id = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">New Post</a></h1>
            <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="post.php">New Post</a></li>
                </ul>
        </div> 

        <form method="post">
            <fieldset>
                <legend>Edit Post</legend>
                <input type="hidden" name="id" value=" <?= $row['id'] ?> ">

                <label for="title">Title</label>
                <input name="title" id="title" value="<?= $row['title'] ?> ">
                <label for="content">Content</label>
                <textarea name="content" id="content" ><?= $row['content'] ?> </textarea>
                <br>
                <input type="submit" name='action' value="Update">
                <input type="submit" name='action' value="Delete">
            </fieldset>
        </form>
    </div>
</body>
</html>