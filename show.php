<?php
    require('connect.php');

    $query = "SELECT * FROM blog WHERE id = :id LIMIT 1";
    $statement = $db->prepare($query);

    $id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);

    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();

    $row = $statement->fetch();
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
    <!-- Remember that alternative syntax is good and html inside php is bad -->\
    <div id="wrapper">
        <div id="header">
                <h1><a href="index.php">Ian's Blog - <?=$row['title'] ?> </a></h1>
                <ul id="menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="post.php">New Post</a></li>
                    </ul>
        </div> 

        <div id="all_blogs">
                <div class="blog_post">
                    <h2><a href="" ><?= $row['title'] ?> </a></h2>
                    <p>
                        Posted: <?= date('F d, Y, h:i a', strtotime($row['date'])) ?> 
                        <a href="<?= "./edit.php?id={$row["id"]}" ?>">Edit</a>
                    </p>
                        <div class="blog_content"> 
                            <?= $row['content'] ?> 
                        </div>
                </div>
        </div>
    </div>
</body>
</html>