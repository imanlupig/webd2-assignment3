<?php
require('connect.php');

if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "DELETE * FROM blog WHERE id = :id";
    $statement = db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    if($statement->execute()){
        header('Location: index.php');
    } else {
        echo "Failed to DELETE";
    }
} else {
    echo "No ID available";
}

?>