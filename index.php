<?php

/*******w******** 
    
    Name: Ian Manlupig 
    Date: 2024-06-17
    Description: Module 3 CRUD Assignment INDEX PAGE

****************/

require('connect.php');

$query = "SELECT * FROM blog ORDER BY id DESC;";

$statement = $db->prepare($query);

$statement->execute(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Ian's Blog</a></h1>
        </div> 
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="post.php">New Post</a></li>
        </ul>
        <div id="all_blogs">
        <?php while($row = $statement->fetch()): ?>
            <div class="blog_post">
                    <h2><a href="<?="./show.php?id={$row["id"]}" ?>" > <?= $row['title']?> </a></h2>
                    <p>
                        Posted: <?= date('F d, Y, h:i a', strtotime($row['date'])) ?> 
                        <a href="<?= "./edit.php?id={$row["id"]}" ?>">Edit</a>
                    </p>
        <?php if (strlen($row['content']) > 200): ?>
                        <div class="blog_content"> 
                            <?= substr($row['content'], 0, 200) ?>... 
                            <a href="<?= "./show.php?id={$row["id"]}" ?>">Read Full Post</a>
                        </div>
         <?php else :?>
                        <div class="blog_content">
                            <?= $row['content'] ?>
                        </div>
        <?php endif ?>
                </div>
        <?php endwhile ?>
        </div>
    </div>
</body>
</html>